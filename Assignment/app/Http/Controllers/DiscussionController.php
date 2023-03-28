<?php

namespace App\Http\Controllers;

use App\Events\DiscussionStarted;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::query()
            ->with(['user', 'lastPost', 'lastPost.user', 'tags'])
            ->withCount('posts')
            ->latest()
            ->get();

        return response()->json($discussions);
    }

    public function show(Discussion $discussion)
    {
        $discussion->loadMissing(['user', 'posts', 'posts.user', 'firstPost']);

        return response()->json($discussion);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:150', 'unique:discussions,title'],
            'content' => ['required', 'string'],
        ]);

        $user = $request->user();

        $discussion = $user->discussions()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
        ]);

        $discussion->posts()->create([
            'content' => $validated['content'],
            'user_id' => $user->id,
            'ip_address' => $request->ip(),
        ]);

        if ($request->boolean('auto_answer')) {
            event(new DiscussionStarted($discussion));
        }

        return response()->json($discussion);
    }
}
