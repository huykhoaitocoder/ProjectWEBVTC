@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="fw-bold mb-3">Đăng ký tài khoản Developer</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Hiển thị lỗi validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('developer.register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên Developer</label>
                <p class="text-muted small">Đây là tên đại diện của bạn trên VH APK, hiển thị trong hồ sơ và ứng dụng của bạn. Bạn có thể thay đổi sau này.</p>
                <input type="text" class="form-control" name="name" placeholder="VD: Công ty ABC" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Nhập email liên hệ" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea class="form-control" name="address" rows="3" placeholder="Nhập địa chỉ của bạn"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Website</label>
                <input type="url" class="form-control" name="website" placeholder="VD: https://example.com">
            </div>

            <button type="submit" class="btn btn-primary w-100">Gửi đăng ký</button>
        </form>
    </div>
</div>
@endsection
