@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <!-- Main Video -->
        <div class="col-md-8">
            <div class="card mb-4">
                <iframe class="card-img-top" src="{{ $video->youtube_embed_url }}" height="400" frameborder="0" allowfullscreen></iframe>
                <div class="card-body">
                    <h4>{{ $video->title }}</h4>
                    <p class="text-muted">
                        {{ $video->category->name ?? 'Uncategorized' }}
                        |
                        Views: {{ $video->visit_count ?? 0 }}
                    </p>
                    {{-- Optional: Description if stored --}}
                </div>
            </div>

            <a href="{{ route('welcome') }}" class="btn btn-sm btn-secondary">← Back to All Videos</a>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="mb-4 p-3 bg-light border">
                <h6>Advertisement</h6>
                <div style="height:150px; background:#ddd; text-align:center; line-height:150px;">Ad Space</div>
            </div>

            <div>
                <h6>More in {{ $video->category->name ?? 'Category' }}</h6>
                @foreach(App\Models\Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->latest()->take(5)->get() as $related)
                    <div class="mb-2">
                        <a href="{{ route('videos.show', $related->id) }}">{{ Str::limit($related->title, 50) }}</a>
                    </div>
                @endforeach
            </div>

             <!-- Top Visited Videos -->
            <div class="mb-4">
                <h6>Top Visited</h6>
               @foreach($topVideos as $vid)
    <div class="mb-2">
        <a href="{{ route('videos.show', $vid->id) }}">
            {{ Str::limit($vid->title, 30) }} ({{ $vid->visit_count }} views)
        </a>
    </div>
@endforeach
            </div>

            <!-- Category Banners -->
            <div>
                <h6>Categories</h6>
                @foreach($categories as $cat)
                    <div class="text-dark m-1">{{ $cat->name }}</div>
                @endforeach
            </div>

            
        </div>

    </div>
</div>
@endsection
