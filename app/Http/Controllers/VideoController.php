<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
{
    $categories = Category::all();
    return view('videos.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'youtube_url' => 'required|url',
        'category_id' => 'nullable|exists:categories,id'
    ]);

    Video::create($request->all());

    return redirect()->route('videos.index')->with('success', 'Video added.');
}


public function edit($id)
{
    $video = Video::findOrFail($id);
    $categories = Category::all();
    return view('videos.edit', compact('video', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'youtube_url' => 'required|url',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    $video = Video::findOrFail($id);
    $video->update($request->only('title', 'youtube_url', 'category_id'));

    return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
}

public function destroy($id)
{
    $video = Video::findOrFail($id);
    $video->delete();

    return response()->json(['success' => true, 'message' => 'Video deleted']);
}


}