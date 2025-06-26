@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add YouTube Video</h2>

    <form method="POST" action="{{ route('videos.store') }}">
        @csrf

        <div class="form-group">
    <label>Select Category:</label>
    <select name="category_id" class="form-control">
        <option value="">-- Select --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
</div>

        <div class="form-group">
            <label>Title:</label>
            <input name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label>YouTube Link (e.g. https://www.youtube.com/watch?v=xxxxx):</label>
            <input name="youtube_url" class="form-control" value="{{ old('youtube_url') }}" required>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
