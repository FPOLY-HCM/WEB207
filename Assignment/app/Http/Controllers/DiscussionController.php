<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::query()
            ->with(['user', 'lastPost', 'lastPost.user', 'tags'])
            ->withCount('posts')
            ->get();

        return response()->json($discussions);
    }

    public function show(Discussion $discussion)
    {
        $discussion->loadMissing(['user', 'firstPost', 'posts', 'posts.user',]);

        return response()->json($discussion);
    }
}
