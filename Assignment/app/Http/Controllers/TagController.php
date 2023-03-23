<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    public function show(string $slug)
    {
        $discussions = Discussion::query()
            ->whereHas('tags', fn ($query) => $query->where('slug', $slug))
            ->get();

        return response()->json($discussions);
    }
}
