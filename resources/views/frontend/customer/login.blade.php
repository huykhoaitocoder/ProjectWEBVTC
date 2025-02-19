@extends('frontend.layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="background: linear-gradient(135deg, #d9f4e5, #b2e0c2);">
    <div class="card shadow-lg p-5" style="width: 100%; max-width: 450px; border-radius: 20px; background-color: #f1f1f1;">
        <h3 class="text-center mb-4" style="color: #2e7d32; font-weight: 600;">
            Chào mừng đến với <span style="color: #1b5e20;">APKRebel Play</span>
        </h3>

        <button class="btn w-100 mb-4 text-white" style="background-color: #0f9d58; font-weight: 500;">
            <i class="fa-brands fa-google me-2"></i> Đăng nhập với Google
        </button>

        <div class="text-center text-muted">hoặc</div>

        <form method="POST" action="/login">
            @csrf
            <div class="form-group mt-3">
                <input type="email" name="user_email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" name="user_password" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label text-muted" for="terms">
                    Kiểm tra ở đây để cho biết rằng bạn đã đọc và đồng ý với 
                    <a href="#" class="text-success text-decoration-none" style="font-weight: 500;">Điều khoản Dịch vụ</a> |
                    <a href="#" class="text-success text-decoration-none" style="font-weight: 500;">Chính sách bảo mật</a>
                </label>
            </div>

            <button type="submit" class="btn w-100 mt-4 text-white" style="background-color: #0f9d58; font-weight: 600;">Đăng nhập</button>
        </form>

        <div class="text-center mt-4">
            <span class="text-muted">Vẫn chưa có tài khoản?</span>
            <a href="/register" class="text-success" style="font-weight: 500;">Đăng ký</a>
        </div>
    </div>
</div>
@endsection
