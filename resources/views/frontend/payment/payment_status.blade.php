<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trạng thái thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<div class="text-center p-4 rounded shadow bg-white">
    <?php if ($status == 'success'): ?>
    <h2 class="text-success">Thanh toán thành công!</h2>
    <p>Cảm ơn bạn đã mua ứng dụng. Giao dịch đã được xác nhận.</p>
    <?php else: ?>
    <h2 class="text-danger">Thanh toán thất bại!</h2>
    <p>Giao dịch không thành công. Vui lòng thử lại.</p>
    <?php endif; ?>
    <a href="/" class="btn btn-primary mt-3">Quay về trang chủ</a>
</div>
</body>
</html>
