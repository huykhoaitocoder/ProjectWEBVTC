<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .active {
            background-color: #007bff;
        }
        .main-content {
            padding: 20px;
        }
        .logout-btn {
            margin-top: auto;
            padding: 15px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row vh-100">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar">
            <h4 class="text-center">Admin Panel</h4>
            <hr>

            <a href="{{ route('admin.apps.index') }}" class="{{ request()->routeIs('admin.apps.*') ? 'active' : '' }}">
                <i class="fas fa-mobile-alt"></i> Quản lý ứng dụng
            </a>
            <a href="#" class="{{ request()->routeIs('admin.versions.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Quản lý phiên bản
            </a>
            <a href="#" class="{{ request()->routeIs('admin.revenue.*') ? 'active' : '' }}">
                <i class="fas fa-dollar-sign"></i> Doanh thu & Thanh toán
            </a>
            <a href="#" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i> Đánh giá & Bình luận
            </a>
            <a href="#" class="{{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> Quản lý thông báo
            </a>
            <a href="#" class="{{ request()->routeIs('admin.marketing.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i> Marketing & Quảng bá
            </a>
            <a href="#" class="{{ request()->routeIs('admin.developers.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i> Quản lý Developer
            </a>
            <a href="#" class="{{ request()->routeIs('admin.api.*') ? 'active' : '' }}">
                <i class="fas fa-code"></i> API Developer
            </a>

            <!-- Nút Đăng xuất -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>

        <!-- Nội dung chính -->
        <main class="col-md-10 main-content">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
