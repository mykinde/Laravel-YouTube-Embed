@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">YouTube Video Gallery</h2>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <form method="GET" action="{{ route('videos.index') }}" class="form-inline">
            <input name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Search videos...">
            <button class="btn btn-secondary">Search</button>
        </form>

        <a href="{{ route('videos.create') }}" class="btn btn-primary">+ Add New Video</a>
    </div>

    <div class="row">
        @forelse($videos as $video)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong>{{ $video->title }}</strong>
                        <small class="text-muted">{{ $video->category->name ?? 'Uncategorized' }}</small>
                    </div>
                    <div class="card-body">
                        <iframe width="100%" height="315" src="{{ $video->youtube_embed_url }}" frameborder="0" allowfullscreen></iframe>

                        <div class="mt-3 d-flex justify-content-between">
                            <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form method="POST" action="{{ route('videos.destroy', $video->id) }}" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No videos found.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
