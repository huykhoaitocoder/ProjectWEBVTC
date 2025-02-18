<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoData['title'] }}</title>
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="keywords" content="{{ implode(',', $seoData['keywords']) }}">
    <link rel="canonical" href="{{ $seoData['canonical'] }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="wrapper">
        @include('frontend.menu')

        @yield('content')

        <footer class="bg-white text-dark pt-5 pb-4">
        <footer class="bg-white text-dark pt-5 pb-4 border-top">
            <div class="container">
                <div class="row">
                    <!-- Cột 1 - Về chúng tôi -->
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase">Về chúng tôi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark">Giới thiệu APKRebel</a></li>
                            <li><a href="#" class="text-dark">Liên hệ chúng tôi</a></li>
                            <li><a href="#" class="text-dark">Chính sách bảo mật</a></li>
                            <li><a href="#" class="text-dark">Điều khoản & Điều kiện</a></li>
                            <li><a href="#" class="text-dark">DMCA</a></li>
                        </ul>
                    </div>

                    <!-- Cột 2 - Liên kết nhanh -->
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase">Liên kết nhanh</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark">Ứng dụng hàng đầu</a></li>
                            <li><a href="#" class="text-dark">Ứng dụng mới</a></li>
                            <li><a href="#" class="text-dark">Ứng dụng miễn phí</a></li>
                            <li><a href="#" class="text-dark">Ứng dụng trả phí</a></li>
                            <li><a href="#" class="text-dark">Ứng dụng đánh giá cao</a></li>
                        </ul>
                    </div>

                    <!-- Cột 3 - Theo dõi chúng tôi -->
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase">Theo dõi chúng tôi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-dark">Facebook</a></li>
                            <li><a href="#" class="text-dark">Twitter</a></li>
                            <li><a href="#" class="text-dark">Instagram</a></li>
                            <li><a href="#" class="text-dark">YouTube</a></li>
                            <li><a href="#" class="text-dark">Telegram</a></li>
                        </ul>
                    </div>

                    <!-- Cột 4 - Liên hệ -->
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase">Liên hệ</h5>
                        <ul class="list-unstyled">
                            <li><a href="mailto:support@apkrebel.com" class="text-dark">support@apkrebel.com</a></li>
                            <li><a href="mailto:info@apkrebel.com" class="text-dark">info@apkrebel.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center mt-4">
                        <p class="mb-0">© 2025 APKRebel Play. Tất cả quyền lợi được bảo lưu.</p>
                        <p class="mb-0">APKRebel không liên kết với Google Play hoặc APKPure.</p>
                    </div>
                </div>
            </div>
</footer>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
