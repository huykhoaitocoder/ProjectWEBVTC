@extends('backend.layout')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>Tải lên file APK</h3>
    <form action="{{ route('file.upload.apk') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="apk_file" class="form-label">Chọn file APK</label>
            <input type="file" name="apk_file" class="form-control" required>
            @error('apk_file')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tải lên</button>
    </form>
</div>
@endsection
