<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffffff, #f0f0f5);
            color: #333;
        }

        .sidebar {
            height: 100vh;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            color: #333;
            transition: all 0.3s ease;
            width: 230px;
            position: fixed;
            overflow: hidden;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        .sidebar a {
            color: #333;
            padding: 15px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s;
            white-space: nowrap;
        }
        .sidebar a i {
            margin-right: 12px;
            font-size: 20px;
            transition: transform 0.3s;
        }
        .sidebar a:hover i {
            transform: scale(1.2);
        }
        .sidebar a:hover, .sidebar a.active {
            background: linear-gradient(45deg, #007bff, #00d4ff);
            color: white;
            border-left: 5px solid #007bff;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Chó pixel di chuyển */
        .dog {
            position: fixed;
            width: 200px;
            height: 200px;
            bottom: 10px;
            left: 0;
            background: url('https://i.giphy.com/d3MKEg2uLlBy8JKE.webp') no-repeat center center;
            background-size: contain;
            transform: scaleX(-1);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar">
            <h4><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-cogs"></i> Admin
                </a></h4>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>

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
            <a href="{{ route('admin.users.management.index') }}" class="{{ request()->routeIs('admin.developers.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i> Quản lý Developer
            </a>
            <a href="#" class="{{ request()->routeIs('admin.api.*') ? 'active' : '' }}">
                <i class="fas fa-code"></i> API Developer
            </a>


        </nav>

        <!-- Nội dung chính -->
        <main class="col-md-10 main-content fade-in">
            @yield('content')
        </main>
    </div>
</div>

<!-- Chó pixel di chuyển -->
<div class="dog" id="dog"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".sidebar a").forEach(link => {
            link.addEventListener("click", function () {
                document.querySelectorAll(".sidebar a").forEach(l => l.classList.remove("active"));
                this.classList.add("active");
            });
        });
    });
</script>

</body>
</html>
