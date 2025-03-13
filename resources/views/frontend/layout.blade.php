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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>
<body>

    <div class="wrapper">
        @include('frontend.menu')

        @yield('content')

        <footer class="bg-white text-dark pt-5 pb-4">
        <footer class="bg-white text-dark pt-5 pb-4 border-top">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase" style="padding-bottom: 12px;">Liên hệ</h5>
                        <ul class="list-unstyled">
                            <li style="padding-bottom: 15px;">Liên hệ ngay nếu bạn có khó khăn khi sử dụng dịch vụ hoặc cần hợp tác.</li>
                            <li>
                                <a href="https://t.me/cvnicky" class="text-dark">
                                    <i class="fab fa-telegram"></i> Chat với hỗ trợ viên
                                </a>
                            </li>
                            <li>
                                <a href="https://web.facebook.com/nickycv36" class="text-dark">
                                    <i class="fab fa-facebook"></i> VH APK
                                </a>
                            </li>
                            <li>
                                <a href="mailto:cvnicky369@gmail.com" class="text-dark">
                                    <i class="fas fa-envelope"></i> support@vhapk.net
                                </a>
                            </li>
                            <li>
                                <i class="far fa-clock"></i> Mon-Sat 08:00am - 10:00pm
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase" style="padding-bottom: 12px;">Thông tin</h5>
                        <ul class="list-unstyled">
                            <li style="padding-bottom: 12px;">VH APK - Kho ứng dụng đa nền tảng chủ yếu tập trung vào Android, cung cấp đa dạng ứng dụng, các ứng dụng bị hạn chế, các phiên bản cũ và các công cụ hỗ trợ.</li>
                            <li><a href="#" class="text-dark text-decoration-none"><i class="fas fa-question-circle me-2"></i> Câu hỏi thường gặp</a></li>
                            <li><a href="#" class="text-dark text-decoration-none"><i class="fas fa-file-contract me-2"></i> Điều khoản sử dụng</a></li>
                        </ul>
                    </div>

                    <div class="col-md-3 mb-4">
                        <h5 class="text-uppercase" style="padding-bottom: 12px;">Nhà phát triển</h5>
                        <ul class="list-unstyled">
                            <li>Nhà phát triển đăng tải ứng dụng lên trang của chúng tôi.</li>
                            <li>Kiếm lợi nhuận không giới hạn từ ứng dụng của chính bạn!</li>
                        </ul>
                        <a href="/developer/register" class="btn btn-primary btn-lg mt-2">Developer Console</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col text-center mt-4">
                        <p class="mb-0">© 2025 VH APK. Tất cả quyền lợi được bảo lưu.</p>
                    </div>
                </div>
            </div>
    </footer>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
</body>
</html>
