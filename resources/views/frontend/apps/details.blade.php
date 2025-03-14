@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <div class="row d-flex align-items-center flex-nowrap">
        <div class="col-auto text-center">
            <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="img-fluid rounded" style="width: 80px; height: 80px;">
        </div>

        <div class="col flex-grow-1">
            <h3 class="fw-bold">{{ $app->name }}</h3>
            <p class="text-muted">{{ $app->developer->name ?? 'Không rõ' }}</p>
            <p class="mb-2">{{ $app->version ?? '1.0.0' }}</p>
            <h4 class="mt-3 {{ $app->price > 0 ? 'text-danger' : 'text-success' }}">
                {{ $app->price > 0 ? number_format($app->price, 0) . ' VNĐ' : 'Miễn phí' }}
            </h4>

            <div class="d-flex align-items-center mb-2">
                <span class="bg-success px-2 py-1 text-white rounded">Ứng dụng đáng tin cậy</span>
            </div>
        </div>

        <div class="col-auto text-end d-md-block d-none">
            @if($app->price > 0)
                @if($userHasPurchased)
                    <a href="#" class="btn btn-lg btn-success">
                        <i class="bi bi-download"></i> Tải xuống lại
                    </a>
                @else
                    <form action="{{ route('payment.method.show',['id' => $app->id])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-download"></i> Mua: {{ number_format($app->price, 0) . ' VNĐ' }}
                        </button>
                    </form>
                @endif
            @else
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-download"></i> Tải về APK
                    </button>
                </form>
            @endif

            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-light mx-1"><i class="bi bi-facebook"></i></button>
                <button class="btn btn-light mx-1"><i class="bi bi-x"></i></button>
                <button class="btn btn-light mx-1"><i class="bi bi-whatsapp"></i></button>
                <button class="btn btn-light mx-1"><i class="bi bi-share"></i></button>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-between mt-4">
        <div class="col-4 flex-grow-1 text-center">
            <p class="fw-bold mb-0">{{ number_format($app->average_rating, 1) }}<i class="fa fa-star" style="font-size:12px; position: relative; top: -2px; left: 2px"></i></p>
            <small>{{ $app->reviews->count() ?? 0 }} Đánh giá</small>
        </div>
        <div class="col-4 flex-grow-1 text-center">
            <p class="fw-bold mb-0">{{ number_format($app->total_downloads) }}</p>
            <small>Lượt tải xuống</small>
        </div>
        <div class="col-4 flex-grow-1 text-center">
            <p class="fw-bold mb-0">Android {{ $app->min_android_version ?? '7.0+' }}</p>
            <small>Android OS</small>
        </div>
    </div>

        <div class="p-4 position-relative">
        <h4 class="text-xl font-semibold mb-4">Ảnh chụp màn hình</h4>
        <div class="position-relative">
            <button id="prevBtn" class="position-absolute start-0 top-50 translate-middle-y bg-white border-0 p-2 shadow rounded-circle"
                    onclick="scrollLeft()"
                    style="z-index: 10; width: 40px; height: 40px; display: none;">
                ❮
            </button>
            <div id="screenshotContainer" class="d-flex overflow-auto gap-3"
                style="scroll-behavior: smooth; white-space: nowrap; scrollbar-width: none; -ms-overflow-style: none; cursor: grab;">
                @foreach($screenshots as $screenshot)
                    <div class="flex-shrink-0" style="scroll-snap-align: start; width: auto;">
                        <img src="{{ $screenshot }}" alt="Screenshot"
                            class="rounded shadow-lg screenshot"
                            style="max-height: 500px; max-width: 100%; object-fit: cover; cursor: pointer;"
                            onclick="openModal(this.src)">
                    </div>
                @endforeach
            </div>
            <button id="nextBtn" class="position-absolute end-0 top-50 translate-middle-y bg-white border-0 p-2 shadow rounded-circle"
                    onclick="scrollRight()"
                    style="z-index: 10; width: 40px; height: 40px;">
                ❯
            </button>
        </div>
    </div>

    <div id="imageModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8);">
        <span class="close" onclick="closeModal()" style="position: absolute; top: 20px; right: 35px; color: white; font-size: 40px; cursor: pointer;">&times;</span>
        <img id="modalImage" class="modal-content" style="margin: auto; display: block; max-width: 90%; max-height: 90%;">
    </div>

        <h4>Giới thiệu về {{ $app->name }}</h4>
        <div class="description" style="white-space: pre-line;">{{ $app->description }}</div>

        <h5 class="mt-4">Thông tin thêm</h5>
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Phiên bản mới nhất</strong>
                    <div>{{ $app->latest_version ?? 'Không rõ' }}</div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Được tải lên bởi</strong>
                    <div>{{ $app->developer->name ?? 'Không rõ' }}</div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Yêu cầu phiên bản</strong>
                    <div>Android {{ $app->min_android_version ?? '7.0+' }}</div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Phát hành vào</strong>
                    <div>{{ \Carbon\Carbon::parse($app->created_at)->format('d/m/Y') }}</div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Danh mục</strong>
                    <div>
                        <a href="{{ route('frontend.categories.show', $app->category->id) }}" class="text-primary">
                            {{ $app->category->name }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Quyền</strong>
                    <div>
                        <a href="{{ route('frontend.report', $app->id) }}" class="text-primary">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>

            {{--<div class="col">
                <div class="border p-3 rounded">
                    <strong>Báo cáo</strong>
                    <div>
                        <a href="{{ route('frontend.report', $app->id) }}" class="text-danger">
                            Gắn cờ là không phù hợp
                        </a>
                    </div>
                </div>
            </div>--}}
        </div>

        <h4 class="mt-5">Phiên bản cũ của {{ $app->name }}</h4>
        <ul class="list-group">
            @forelse($app->versions as $version)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $version->version_name }}</strong> - {{ $version->file_size }} MB
                        <br><small>Cập nhật: {{ $version->created_at?->format('d/m/Y') ?? 'Không rõ' }}</small>
                    </div>
                    <a href="{{ $version->download_link }}" class="btn btn-success">Tải về</a>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">
                    Không có phiên bản cũ nào.
                </li>
            @endforelse
        </ul>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Đánh giá của người dùng</h2>

            @if(auth()->check())
                @if(!$userReview)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                        + Đánh giá
                    </button>
                @endif
            @else
                <p><a href="{{ route('login') }}">Đăng nhập</a> để đánh giá ứng dụng.</p>
            @endif

            @include('frontend.reviews.create')
        </div>

        @if(auth()->check())
                @if($userReview)
                    <div class="your-review p-4 border rounded-2xl shadow-sm bg-light">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $userReview->user->avatar ?? asset('images/user-icon.png') }}"
                                alt="Avatar"
                                class="rounded-circle me-3"
                                width="50" height="50">
                            <h5 class="mb-0">{{ $userReview->user->name }}</h5>
                        </div>

                        <div class="mb-2">
                            <p class="mb-1">
                                ⭐ {{ $userReview->rating }}/5
                                <span class="text-muted ms-2">{{ $userReview->created_at->format('d/m/Y') }}</span>
                            </p>
                        </div>

                        <p class="mb-3">{{ $userReview->comment }}</p>

                        <div class="d-flex">
                            <button type="button" class="btn btn-success h-100 me-2" data-bs-toggle="modal" data-bs-target="#editReviewModal">Sửa</button>

                            @include('frontend.reviews.edit')

                            <form action="{{ route('reviews.destroy', $userReview->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Xóa</button>
                            </form>
                        </div>
                    </div>
                @endif
        @endif

        <div class="rating-summary mb-4 p-3 border rounded">
            <div class="d-flex align-items-center">
                <div class="text-center me-4">
                    <div class="display-4 fw-bold">{{ number_format($app->average_rating, 1) }}</div>
                    <p>{{ $app->reviews->count() }} Đánh giá</p>
                </div>
                <div class="flex-grow-1">
                    @for ($i = 5; $i >= 1; $i--)
                        @php
                            $count = $app->reviews->where('rating', $i)->count();
                            $percentage = $app->reviews->count() ? ($count / $app->reviews->count()) * 100 : 0;
                        @endphp
                        <div class="d-flex align-items-center mb-1">
                            <span class="me-2">{{ $i }} ⭐</span>
                            <div class="progress flex-grow-1" style="height: 10px;">
                                <div class="progress-bar bg-success" style="width: {{ $percentage }}%;"></div>
                            </div>
                            <span class="ms-2">{{ $count }}</span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <ul class="list-group">
            @forelse($app->reviews->take(3) as $review)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $review->user->name }}</strong>
                        <span class="text-muted">{{ $review->created_at->format('Y-m-d') }}</span>
                    </div>
                    <p class="mb-1">{{ $review->comment }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Đánh giá: {{ $review->rating }} ⭐</span>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-center text-muted">Chưa có đánh giá nào.</li>
            @endforelse
        </ul>
        <div class="text-center mt-3">
            <button class="btn btn-outline-primary">Hiển thị nhiều hơn</button>
        </div>

        <div class="similar-games-section">
            <div class="app-section">
                <h3 class="mt-4 mb-3">Tương tự như {{ $app->name }}</h3>
                <div class="app-list-container">
                    <button class="scroll-btn left">&lt;</button> <!-- Nút cuộn trái -->
                    <div class="app-list">
                        @foreach($similarApps as $similarApp)
                            <div class="app-item">
                                <a href="{{ route('app.details', $similarApp->id) }}">
                                    <img src="{{ asset($similarApp->icon) }}" alt="{{ $similarApp->name }}" class="app-icon">
                                    <p class="app-name">{{ $similarApp->name }}</p>
                                    <p class="app-rating">
                                        {{ number_format($similarApp->average_rating, 1) }}
                                        <i class="fa fa-star"></i>
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button class="scroll-btn right">&gt;</button> <!-- Nút cuộn phải -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    const carousel = document.getElementById('similar-games-carousel');

    function scrollCarousel(direction) {
        const scrollAmount = 200;
        carousel.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }

    function sortSimilarApps() {
        const select = document.getElementById('sortSelect');
        const cards = Array.from(carousel.children);

        cards.sort((a, b) => {
            const ratingA = parseFloat(a.querySelector('span').innerText.replace('★ ', ''));
            const ratingB = parseFloat(b.querySelector('span').innerText.replace('★ ', ''));
            const downloadsA = parseInt(a.dataset.downloads || 0);
            const downloadsB = parseInt(b.dataset.downloads || 0);
            const nameA = a.querySelector('p').innerText;
            const nameB = b.querySelector('p').innerText;

            switch (select.value) {
                case 'rating': return ratingB - ratingA;
                case 'downloads': return downloadsB - downloadsA;
                case 'name': return nameA.localeCompare(nameB);
                default: return 0;
            }
        });

        carousel.innerHTML = '';
        cards.forEach(card => carousel.appendChild(card));
    }

    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('screenshotContainer');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let isDown = false;
        let startX;
        let scrollLeft;

        function updateButtons() {
            prevBtn.style.display = container.scrollLeft > 10 ? 'block' : 'none';
            nextBtn.style.display = container.scrollLeft + container.clientWidth < container.scrollWidth - 10 ? 'block' : 'none';
        }

        function scrollLeft() {
            container.scrollBy({ left: -container.clientWidth, behavior: 'smooth' });
            setTimeout(updateButtons, 500);
        }

        function scrollRight() {
            container.scrollBy({ left: container.clientWidth, behavior: 'smooth' });
            setTimeout(updateButtons, 500);
        }

        container.addEventListener('scroll', updateButtons);
        container.addEventListener('wheel', (event) => {
            event.preventDefault();
            container.scrollBy({ left: event.deltaY * 2, behavior: 'smooth' });
            setTimeout(updateButtons, 500);
        });

        // Drag scrolling
        container.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
            container.style.cursor = 'grabbing';
        });

        container.addEventListener('mouseleave', () => {
            isDown = false;
            container.style.cursor = 'grab';
        });

        container.addEventListener('mouseup', () => {
            isDown = false;
            container.style.cursor = 'grab';
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2;
            container.scrollLeft = scrollLeft - walk;
        });

        window.onload = updateButtons;
        prevBtn.addEventListener("click", scrollLeft);
        nextBtn.addEventListener("click", scrollRight);
    });

    function openModal(src) {
        document.getElementById("imageModal").style.display = "block";
        document.getElementById("modalImage").src = src;
    }

    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }
</script>
