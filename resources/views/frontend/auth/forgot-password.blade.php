@extends('frontend.layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #d9f4e5, #b2e0c2);">
    <div class="card shadow-lg p-5" style="width: 100%; max-width: 450px; border-radius: 20px; background-color: #f1f1f1;">
        <h3 class="text-center mb-4" style="color: #2e7d32; font-weight: 600;">Quên mật khẩu</h3>
        <p class="text-center text-muted mb-4">Nhập email để nhận liên kết đặt lại mật khẩu</p>

        @if (session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group mt-3">
                <input type="email" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn w-100 mt-4 text-white" style="background-color: #0f9d58; font-weight: 600;">Gửi liên kết đặt lại mật khẩu</button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-success" style="font-weight: 500;">Quay lại đăng nhập</a>
        </div>
    </div>
</div>
@endsection