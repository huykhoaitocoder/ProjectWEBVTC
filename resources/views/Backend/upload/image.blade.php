
<div class="container mt-5">
    <h2>Tải nhiều ảnh lên Cloudinary</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        <div class="row">
            @foreach(session('urls') as $url)
                <div class="col-md-4 mt-3">
                    <img src="{{ $url }}" class="img-fluid" alt="Uploaded Image">
                    <p>{{ $url }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="images" class="form-label">Chọn ảnh</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Tải lên</button>
    </form>
</div>

