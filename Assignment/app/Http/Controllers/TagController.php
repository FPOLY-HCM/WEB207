<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function index(): JsonResponse
    {
        $tags = Tag::query()
            ->withCount('discussions')
            ->get();

        return response()->json($tags);
    }

    public function show(string $slug): JsonResponse
    {
        $discussions = Discussion::query()
            ->whereHas('tags', fn ($query) => $query->where('slug', $slug))
            ->with(['user', 'lastPost', 'lastPost.user', 'tags'])
            ->withCount('posts')
            ->get();

        return response()->json($discussions);
    }
}
