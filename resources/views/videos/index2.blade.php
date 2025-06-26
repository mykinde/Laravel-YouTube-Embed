@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">YouTube Video Gallery</h2>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <form method="GET" action="{{ route('videos.index') }}" class="form-inline">
            <input name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Search videos...">
            <button class="btn btn-secondary">Search</button>
        </form>
        <a href="{{ route('videos.create') }}" class="btn btn-primary">+ Add Video</a>
    </div>

    <div class="row">
        @forelse($videos as $video)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong>{{ $video->title }}</strong>
                        <span class="text-muted">{{ $video->category->name ?? 'Uncategorized' }}</span>
                    </div>
                    <div class="card-body">
                        <iframe width="100%" height="315" src="{{ $video->youtube_embed_url }}" frameborder="0" allowfullscreen></iframe>
                        <div class="mt-3 d-flex justify-content-between">
                            <button class="btn btn-sm btn-info edit-btn"
                                data-id="{{ $video->id }}"
                                data-title="{{ $video->title }}"
                                data-url="{{ $video->youtube_url }}">
                                Edit
                            </button>

                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $video->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No videos available.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editVideoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editVideoForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Video</h5>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-video-id">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="edit-title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>YouTube URL</label>
                    <input type="url" id="edit-url" name="youtube_url" class="form-control" required>
                </div>
                {{-- Optional: Add category dropdown --}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Video</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // DELETE
    $('.delete-btn').click(function() {
        if (!confirm('Are you sure you want to delete this video?')) return;

        var id = $(this).data('id');

        $.ajax({
            url: '/videos/' + id,
            type: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function() {
                alert('Failed to delete video.');
            }
        });
    });

    // EDIT
    $('.edit-btn').click(function() {
        $('#edit-video-id').val($(this).data('id'));
        $('#edit-title').val($(this).data('title'));
        $('#edit-url').val($(this).data('url'));
        $('#editVideoModal').modal('show');
    });

    $('#editVideoForm').submit(function(e) {
        e.preventDefault();

        var id = $('#edit-video-id').val();
        var data = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            title: $('#edit-title').val(),
            youtube_url: $('#edit-url').val()
        };

        $.ajax({
            url: '/videos/' + id,
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Video updated.');
                location.reload();
            },
            error: function() {
                alert('Update failed.');
            }
        });
    });
</script>
@endpush
