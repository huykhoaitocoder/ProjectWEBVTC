<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seoData['title'] }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}">
    <link rel="canonical" href="{{ $seoData['canonical'] }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-x..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
