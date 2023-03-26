<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::query()
            ->with(['user', 'lastPost', 'lastPost.user'])
            ->get();

        return $discussions;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Discussion $discussion)
    {
        $discussion->loadMissing(['user', 'firstPost', 'posts', 'posts.user',]);

        return $discussion;
    }

    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    public function destroy(Discussion $discussion)
    {
        //
    }
}
