<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            background: linear-gradient(135deg, #4CAF50, #2c3e50);
            color: white;
            padding: 15px 0;
        }
        .header img.logo {
            height: 50px;
        }
        .nav-link, .navbar-brand {
            color: white !important;
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 30px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                <img src="https://i.pinimg.com/736x/8d/16/90/8d16902ae35c1e982c2990ff85fa11fb.jpg" alt="Logo" class="logo me-2">
                <span>Chợ Phần Mềm</span>
            </a>
        </div>
        <a href="#" class="nav-link d-inline-block">
            <i class="bi bi-box"></i> Game
        </a>
        <a href="#" class="nav-link d-inline-block">
            <i class="bi bi-envelope"></i> Ứng Dụng
        </a>

    </div>
</div>

<div class="container mt-4">
    @yield('content')
</div>

<div class="footer">
    <p>© 2025 Chợ Phần Mềm. All rights reserved. | <a href="#">Chính sách bảo mật</a> | <a href="#">Điều khoản sử dụng</a></p>
</div>
</body>
</html>
