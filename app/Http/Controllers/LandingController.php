<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;



class LandingController extends Controller
{

public function welcome(Request $request)
{
    $query = Video::query()->with('category');

    if ($request->search) {
        $query->where('title', 'LIKE', '%' . $request->search . '%');
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $videos = $query->latest()->paginate(6);
    $categories = Category::all();

    // Example: top visited could be based on a visit_count column
    $topVideos = Video::orderBy('visit_count', 'desc')->take(5)->get();

    return view('welcome', compact('videos', 'categories', 'topVideos'));
}


public function show(Video $video)
{
    // Optional: Track views
    $video->increment('visit_count');
     $categories = Category::all();
     $topVideos = Video::orderBy('visit_count', 'desc')->take(5)->get();

    return view('videos.show', compact('video', 'categories','topVideos'));
}


}
