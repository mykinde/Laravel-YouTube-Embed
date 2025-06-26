@extends('layouts.app')

@section('content')
<div class="container">
    <h2>YouTube Video Gallery</h2>
    <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">Add Video</a>

    <div class="row">
        @foreach($videos as $video)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">{{ $video->title }}</div>
                    <div class="card-body">
                        <iframe width="100%" height="315" src="{{ $video->youtube_embed_url }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-sm btn-warning mt-2">Edit</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
