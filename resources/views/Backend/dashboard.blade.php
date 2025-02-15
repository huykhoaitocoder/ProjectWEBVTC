<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bán Phần Mềm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h3>Dashboard</h3>
        <a href="#">Tổng Quan</a>
        <a href="#">Quản Lý Sản Phẩm</a>
        <a href="#">Đơn Hàng</a>
        <a href="#">Khách Hàng</a>
        <a href="#">Báo Cáo</a>
        <div class="mt-3">
            <p>Xin chào, <strong>{{ $user->name }}</strong></p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Đăng Xuất</button>
            </form>
        </div>
    </div>
    <!-- Content -->
    <div class="content flex-grow-1">
        <div class="container">
            <h1 class="text-primary mb-4">Chào mừng đến với Dashboard</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Sản Phẩm Đã Bán</h5>
                            <p class="card-text">150 sản phẩm</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Đơn Hàng Mới</h5>
                            <p class="card-text">20 đơn hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Khách Hàng Mới</h5>
                            <p class="card-text">30 khách hàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
