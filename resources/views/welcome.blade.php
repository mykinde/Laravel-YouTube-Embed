@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Top Controls -->
    <form method="GET" action="{{ route('welcome') }}" class="form-inline mb-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <div class="form-group">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search videos...">
        </div>
        <div class="form-group">
            <select name="category_id" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Filter</button>
    </form>

    <!-- Main Grid -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-md-8">
            <h4>Recently Added Videos</h4>
            <div class="row">
                @forelse($videos as $video)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <iframe class="card-img-top" src="{{ $video->youtube_embed_url }}" frameborder="0" allowfullscreen></iframe>
                            <div class="card-body">
                                 <h6 class="card-title"> <a href="{{ route('videos.show', $video->id) }}"> {{ Str::limit($video->title, 60) }} </a></h6>
                                <small class="text-muted">{{ $video->category->name ?? 'Uncategorized' }}</small>
                            </div>
                           
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">No videos found.</p>
                    </div>
                @endforelse
            </div>

            {{ $videos->appends(request()->query())->links() }}
        </div>

        <!-- Right Column -->
        <div class="col-md-4">
            <!-- Ad Section -->
            <div class="mb-4 p-3 bg-light border">
                <h6>Advertisement</h6>
                <div style="height:150px; background:#ddd; text-align:center; line-height:150px;">Ad Space</div>
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
