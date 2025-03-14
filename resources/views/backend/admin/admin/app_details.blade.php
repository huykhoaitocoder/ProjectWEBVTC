@extends('Backend.admin.layouts.master')

@section('title', 'Chi tiết ứng dụng')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Chi tiết ứng dụng
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ $app->icon }}" alt="Icon" class="img-fluid rounded" width="120">
                    </div>
                    <div class="col-md-9">
                        <h3>{{ $app->name }}</h3>
                        <p><strong>Danh mục:</strong> {{ $app->category->name ?? 'Không có' }}</p>
                        <p><strong>Developer:</strong> {{ $app->developer->name ?? 'Không rõ' }}</p>
                        <p><strong>Giá:</strong> {{ number_format($app->price, 0, ',', '.') }} VND</p>
                        <p><strong>Trạng thái:</strong>
                        <form action="{{ route('admin.update.status', $app->id) }}" method="POST" class="d-inline">
                            @csrf
                            <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                                <option value="approved" {{ $app->status == 'approved' ? 'selected' : '' }}>Đang bán</option>
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Bị xoá</option>
                            </select>
                        </form>
                        </p>
                    </div>
                </div>

                <hr>
                <h5>Mô tả</h5>
                <p>{!! nl2br(e($app->description)) !!}</p>

                <hr>
                <h5>Thông tin Phiên bản</h5>
                @foreach($app->versions as $version)
                    <div class="card mt-3">
                        <div class="card-header bg-secondary text-white">
                            Phiên bản: {{ $version->version_name }}
                        </div>
                        <div class="card-body">
                            <p><strong>Changelog:</strong> {!! nl2br(e($version->changelog)) !!}</p>
                            <p><strong>File APK:</strong> <a href="{{ $version->apk_path }}" download>Tải về</a></p>
                            <p><strong>Kích thước:</strong> {{ $version->file_size }} MB</p>
                            <p><strong>Trạng thái:</strong> {{ $version->status }}</p>

                            @if(is_array($version->screenshots) && count($version->screenshots) > 0)
                                <h6>Ảnh chụp màn hình:</h6>
                                <div class="row">
                                    @foreach($version->screenshots as $screenshot)
                                        <div class="col-md-3 mb-2">
                                            <a href="{{ $screenshot }}" data-lightbox="screenshots">
                                                <img src="{{ $screenshot }}" class="img-fluid rounded img-thumbnail screenshot-img">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Không có ảnh chụp màn hình.</p>
                            @endif

                            @if(!empty($version->video))
                                <h6>Video:</h6>
                                <div class="video-container">
                                    <iframe width="100%" height="315" src="{{ $version->video }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @else
                                <p>Không có video.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Thêm thư viện Lightbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- CSS tùy chỉnh -->
    <style>
        .screenshot-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
