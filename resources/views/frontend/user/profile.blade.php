@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
    <div class="col-md-4 text-center">
        <div class="card p-4 shadow-sm d-flex justify-content-center align-items-center">
            <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/user-icon.png') }}" 
                class="rounded-circle img-thumbnail mb-3" width="90" alt="Avatar">
            <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
            <p class="text-muted">{{ auth()->user()->email }}</p>
            <button class="btn btn-primary btn-sm" onclick="document.getElementById('avatar-input').click();">
                Thay đổi Avatar
            </button>
            <form action="{{ route('profile.update_avatar') }}" method="POST" enctype="multipart/form-data" class="d-none">
                @csrf
                <input type="file" id="avatar-input" name="avatar" onchange="this.form.submit();">
            </form>
        </div>
    </div>

        <div class="col-md-8">
            <div class="card p-4 shadow-sm">
                <h4 class="mb-4">Cập Nhật Hồ Sơ</h4>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" name="full_name" class="form-control" value="{{ auth()->user()->full_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-control" value="{{ auth()->user()->website }}">
                    </div>
                    <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
