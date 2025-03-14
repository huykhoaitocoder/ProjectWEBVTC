<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - App Store</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: none;
            color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .card i {
            font-size: 48px;
            margin-bottom: 12px;
            color: #007bff;
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

<!-- Sidebar -->
<nav class="sidebar p-3" id="sidebar">
    <h4><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
            <i class="fas fa-cogs"></i> Admin
        </a></h4>

    <a href="#" class="active"><i class="fa-solid fa-mobile-screen"></i> Ứng dụng</a>
    <a href="#"><i class="fa-solid fa-code-branch"></i> Phiên bản</a>
    <a href="#"><i class="fa-solid fa-sack-dollar"></i> Doanh thu</a>
    <a href="#"><i class="fa-solid fa-comments"></i> Đánh giá</a>
    <a href="#"><i class="fa-solid fa-bell"></i> Thông báo</a>
    <a href="#"><i class="fa-solid fa-bullhorn"></i> Quảng bá</a>
    <a href="{{ route('admin.users.management.index') }}"><i class="fa-solid fa-user-gear"></i> Developer</a>
    <a href="{{ route('admin.users.management.index') }}"><i class="fa-solid fa-code"></i> API</a>
</nav>

<!-- Main content -->
<main class="content">
    <h2 class="mb-4"><i class="fa-solid fa-chart-line"></i> Dashboard</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 fade-in">
        <div class="col">
            <div class="card text-center p-4">
                <i class="fa-solid fa-mobile-screen"></i>
                <h5>Quản lý ứng dụng</h5>
                <p>Thêm, sửa, xóa ứng dụng.</p>
                <a href="{{ route('admin.apps.index') }}" class="btn btn-primary btn-sm">Quản lý</a>
            </div>
        </div>
        <div class="col">
            <div class="card text-center p-4">
                <i class="fa-solid fa-code-branch"></i>
                <h5>Quản lý phiên bản</h5>
                <p>Xem lịch sử phiên bản.</p>
                <a href="#" class="btn btn-primary btn-sm">Xem</a>
            </div>
        </div>
        <div class="col">
            <div class="card text-center p-4">
                <i class="fa-solid fa-sack-dollar"></i>
                <h5>Doanh thu</h5>
                <p>Xem báo cáo doanh thu.</p>
                <a href="#" class="btn btn-primary btn-sm">Báo cáo</a>
            </div>
        </div>
    </div>
</main>

<!-- Chó pixel di chuyển -->
<div class="dog" id="dog"></div>


</body>
</html>
