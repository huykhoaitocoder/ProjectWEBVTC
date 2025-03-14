<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phương thức thanh toán</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .app-info {
            max-width: 600px;
            margin: 0 auto 20px auto;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .payment-methods {
            max-width: 500px;
            margin: 0 auto;
        }
        .payment-card {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .payment-card img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-right: 15px;
        }
        .payment-card .details {
            flex-grow: 1;
        }
        .btn-pay {
            width: 100%;
            padding: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <!-- Thông tin ứng dụng -->
    <div class="app-info text-center">
        <h4 class="fw-bold">{{ $app->name }}</h4>
        <p class="text-muted" style="text-align: justify; white-space: pre-line;">
            {{ $app->description }}
        </p>
        <h5 class="text-danger fw-bold">{{ number_format($app->price, 0, ',', '.') }} VND</h5>
    </div>

    <!-- Danh sách phương thức thanh toán -->
    <h4 class="text-center">Chọn phương thức thanh toán</h4>
    <div class="payment-methods">

        <!-- Thanh toán VNPAY -->
        <div class="payment-card">
            <img src="https://upload.wikimedia.org/wikipedia/vi/thumb/0/09/VNPAY_Logo.png/220px-VNPAY_Logo.png" alt="VNPAY">
            <div class="details">
                <h6 class="mb-1">VNPAY</h6>
                <p class="text-muted m-0">Thanh toán qua cổng VNPAY</p>
            </div>
            <form action="{{ route('payment.vnpay') }}" method="POST">
                @csrf
                <input type="hidden" name="app_id" value="{{ $app->id }}">
                <input type="hidden" name="app_name" value="{{ $app->name }}">
                <input type="hidden" name="app_price" value="{{ $app->price }}">
                <button type="submit" class="btn btn-primary mt-2">Thanh toán ngay</button>
            </form>
        </div>

        <!-- Thanh toán MoMo -->
        <div class="payment-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fe/MoMo_Logo.png" alt="MoMo">
            <div class="details">
                <h6 class="mb-1">MoMo</h6>
                <p class="text-muted m-0">Thanh toán qua ví điện tử MoMo</p>
            </div>
            <form action="{{ route('payment.momo') }}" method="POST">
                @csrf
                <input type="hidden" name="app_id" value="{{ $app->id }}">
                <input type="hidden" name="app_name" value="{{ $app->name }}">
                <input type="hidden" name="app_price" value="{{ $app->price }}">
                <button type="submit" class="btn btn-primary mt-2">Thanh toán ngay</button>
            </form>
        </div>

        <!-- Thanh toán ZaloPay -->
        <div class="payment-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/ZaloPay_Logo.svg/1024px-ZaloPay_Logo.svg.png" alt="ZaloPay">
            <div class="details">
                <h6 class="mb-1">ZaloPay</h6>
                <p class="text-muted m-0">Thanh toán qua ví ZaloPay</p>
            </div>
            <form action="{{ route('payment.zalopay') }}" method="POST">
                @csrf
                <input type="hidden" name="app_id" value="{{ $app->id }}">
                <input type="hidden" name="app_name" value="{{ $app->name }}">
                <input type="hidden" name="app_price" value="{{ $app->price }}">
                <button type="submit" class="btn btn-primary mt-2">Thanh toán ngay</button>
            </form>
        </div>
        <!-- Thanh toán ZaloPay -->
        <div class="payment-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/ZaloPay_Logo.svg/1024px-ZaloPay_Logo.svg.png" alt="ZaloPay">
            <div class="details">
                <h6 class="mb-1">Internet Banking</h6>
                <p class="text-muted m-0">Thanh toán qua Internet Banking</p>
            </div>
            <form action="{{ route('payment.momo.qr') }}" method="POST">
                @csrf
                <input type="hidden" name="app_id" value="{{ $app->id }}">
                <input type="hidden" name="app_name" value="{{ $app->name }}">
                <input type="hidden" name="app_price" value="{{ $app->price }}">
                <button type="submit" class="btn btn-primary mt-2">Thanh toán ngay</button>
            </form>
        </div>

        <!-- Thanh toán PayPal -->
        <div class="payment-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">
            <div class="details">
                <h6 class="mb-1">PayPal</h6>
                <p class="text-muted m-0">Thanh toán bằng tài khoản PayPal</p>
            </div>
            <form action="{{ route('payment.paypal') }}" method="POST">
                @csrf
                <input type="hidden" name="app_id" value="{{ $app->id }}">
                <input type="hidden" name="app_name" value="{{ $app->name }}">
                <input type="hidden" name="app_price" value="{{ $app->price }}">
                <button type="submit" class="btn btn-primary mt-2">Thanh toán ngay</button>
            </form>
        </div>

    </div>

    <!-- Nút quay lại trang chủ -->
    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">Quay về trang chủ</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
