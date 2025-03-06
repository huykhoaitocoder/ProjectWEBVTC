@extends('backend.layout')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        <video width="600" controls>
        <source src="{{ explode('URL: ', session('success'))[1] }}" type="video/mp4">
        Trình duyệt không hỗ trợ video.
    </video>
    @endif

    <h3>Tải lên video</h3>
    <form action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="video_file" class="form-label">Chọn video</label>
            <input type="file" name="video_file" class="form-control" required>
            @error('video_file')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Tải lên</button>
    </form>
</div>
@endsection
