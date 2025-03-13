<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - App Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .sidebar h4 {
            margin-bottom: 20px;
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar p-3">
            <h4 class="text-center"><i class="fa-solid fa-gear"></i> Admin Panel</h4>
            <a href="#" class="active"><i class="fa-solid fa-mobile-screen"></i> Quản lý ứng dụng</a>
            <a href="#"><i class="fa-solid fa-code-branch"></i> Quản lý phiên bản</a>
            <a href="#"><i class="fa-solid fa-sack-dollar"></i> Doanh thu & Thanh toán</a>
            <a href="#"><i class="fa-solid fa-comments"></i> Đánh giá & Bình luận</a>
            <a href="#"><i class="fa-solid fa-bell"></i> Thông báo hệ thống</a>
            <a href="#"><i class="fa-solid fa-bullhorn"></i> Marketing & Quảng bá</a>
            <a href="#"><i class="fa-solid fa-user-gear"></i> Tài khoản Developer</a>
            <a href="#"><i class="fa-solid fa-code"></i> API Developer</a>
            <div class="mt-4 text-center border-top pt-3">
                <p><i class="fa-solid fa-user-circle"></i> Nguyễn Quang Huy</p>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-danger btn-sm">Đăng xuất</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-10 p-4">
            <h2 class="mb-4"><i class="fa-solid fa-chart-line"></i> Dashboard - App Store</h2>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <!-- Card 1 -->
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-mobile-screen fa-2x mb-2"></i>
                        <h5>Quản lý ứng dụng</h5>
                        <p>Thêm, sửa, xóa ứng dụng, cập nhật phiên bản.</p>
                        <a href="{{ route('admin.apps.index') }}" class="btn btn-primary btn-sm">Quản lý ngay</a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-code-branch fa-2x mb-2"></i>
                        <h5>Quản lý phiên bản</h5>
                        <p>Tải lên phiên bản mới, xem lịch sử phiên bản.</p>
                        <a href="#" class="btn btn-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-sack-dollar fa-2x mb-2"></i>
                        <h5>Doanh thu & Thanh toán</h5>
                        <p>Xem báo cáo doanh thu, lịch sử thanh toán.</p>
                        <a href="#" class="btn btn-primary btn-sm">Xem báo cáo</a>
                    </div>
                </div>
                <!-- Các card tiếp theo -->
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-comments fa-2x mb-2"></i>
                        <h5>Đánh giá & Bình luận</h5>
                        <p>Xem đánh giá và phản hồi người dùng.</p>
                        <a href="#" class="btn btn-primary btn-sm">Quản lý đánh giá</a>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-bell fa-2x mb-2"></i>
                        <h5>Thông báo hệ thống</h5>
                        <p>Nhận thông báo từ hệ thống.</p>
                        <a href="#" class="btn btn-primary btn-sm">Xem thông báo</a>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-3 shadow-sm">
                        <i class="fa-solid fa-bullhorn fa-2x mb-2"></i>
                        <h5>Marketing & Quảng bá</h5>
                        <p>Tạo chiến dịch quảng cáo, giảm giá app.</p>
                        <a href="#" class="btn btn-primary btn-sm">Thực hiện ngay</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.sidebar a').on('click', function() {
            $('.sidebar a').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

</body>
</html>
