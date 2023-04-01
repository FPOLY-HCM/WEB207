<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReplyDiscussionController extends Controller
{
    public function __invoke(Request $request, Discussion $discussion): JsonResponse
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        $discussion->posts()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id,
            'ip_address' => $request->ip(),
        ]);

        $discussion->loadMissing(['user', 'posts', 'posts.user', 'firstPost']);

        return response()->json($discussion);
    }
}
