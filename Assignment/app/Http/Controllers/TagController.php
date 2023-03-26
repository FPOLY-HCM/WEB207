<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::query()
            ->withCount('discussions')
            ->get();

        return response()->json($tags);
    }

    public function show(string $slug)
    {
        $discussions = Discussion::query()
            ->whereHas('tags', fn ($query) => $query->where('slug', $slug))
            ->with(['user', 'lastPost', 'lastPost.user', 'tags'])
            ->withCount('posts')
            ->get();

        return response()->json($discussions);
    }
}
