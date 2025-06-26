@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Video</h2>

    <form method="POST" action="{{ route('videos.update', $video->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title:</label>
            <input name="title" class="form-control" value="{{ old('title', $video->title) }}" required>
        </div>

        <div class="form-group">
            <label>YouTube URL:</label>
            <input name="youtube_url" class="form-control" value="{{ old('youtube_url', $video->youtube_url) }}" required>
        </div>

        <div class="form-group">
            <label>Category:</label>
            <select name="category_id" class="form-control">
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $video->category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
