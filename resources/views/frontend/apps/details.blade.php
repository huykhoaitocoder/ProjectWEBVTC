@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-2 text-center">
            <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="img-fluid rounded">
        </div>
        <div class="col-md-7">
            <h3 class="fw-bold">{{ $app->name }}</h3>
            <p class="text-muted">{{ $app->developer->name ?? 'Không rõ' }}</p>
            <p class="mb-2">{{ $app->version ?? '1.0.0' }}</p>
            <h4 class="mt-3 {{ $app->price > 0 ? 'text-danger' : 'text-success' }}">
                {{ $app->price > 0 ? number_format($app->price, 2) . ' VNĐ' : 'Miễn phí' }}
            </h4>

            <div class="d-flex align-items-center mb-2">
                <span class="bg-success me-2">Ứng dụng đáng tin cậy</span>
            </div>
        </div>
        <div class="col-md-3 text-end">
            @if($app->price > 0)
                    @if($userHasPurchased)
                        <a href="#" class="btn btn-lg btn-success w-100">
                            <i class="bi bi-download"></i> Tải xuống lại
                        </a>
                    @else
                        <a href="#" class="btn btn-lg btn-success w-100">
                            <i class="bi bi-download"></i> Mua: {{ number_format($app->price, 2) . ' VNĐ' }}
                        </a>
                    @endif
                @else
                    <a href="#" class="btn btn-lg btn-success w-100">
                        <i class="bi bi-download"></i> Tải về APK
                    </a>
                @endif

            <div class="d-flex justify-content-around mt-3">
                <button class="btn btn-light"><i class="bi bi-facebook"></i></button>
                <button class="btn btn-light"><i class="bi bi-x"></i></button>
                <button class="btn btn-light"><i class="bi bi-whatsapp"></i></button>
                <button class="btn btn-light"><i class="bi bi-share"></i></button>
            </div>
        </div>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-4">
            <p class="fw-bold mb-0">{{ number_format($app->average_rating, 1) }}<i class="fa fa-star" style="font-size:12px; position: relative; top: -2px; left: 2px"></i></p>
            <small>{{ $app->reviews_count ?? 0 }} Đánh giá</small>
        </div>
        <div class="col-md-4">
            <p class="fw-bold mb-0">{{ number_format($app->total_downloads) }}</p>
            <small>Lượt tải xuống</small>
        </div>
        <div class="col-md-4">
            <p class="fw-bold mb-0">Android {{ $app->min_android_version ?? '7.0+' }}</p>
            <small>Android OS</small>
        </div>
    </div>

    <div class="card shadow-lg p-4">        
        <h4 class="mt-5">Ảnh chụp màn hình</h4>
        <div class="d-flex overflow-auto gap-3">
            @foreach($app->screenshots as $screenshot)
                <img src="{{ asset($screenshot->image_url) }}" alt="Screenshot" class="rounded">
            @endforeach
        </div>

        <h4>Giới thiệu về {{ $app->name }}</h4>
        <p class="fw-bold">{{ $app->short_description }}</p>
        <p>{{ $app->description }}</p>

        {{-- Thông tin thêm --}}
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
                    <div>{{ $app->created_at->format('d/m/Y') }}</div>
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
                        <strong>{{ $version->version_name }}</strong> - {{ $version->size }} MB  
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
                        <div>
                            <span class="me-3">👍 {{ $review->likes_count ?? 0 }}</span>
                            <a href="#">Trả lời</a>
                        </div>
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
            <h2 class="text-2xl font-semibold mb-4">Các trò chơi như {{ $app->name }}</h2>
            <div class="relative">
                <div id="similar-games-carousel" class="flex overflow-x-auto gap-4 scroll-smooth pb-2">
                    @foreach($similarApps as $similarApp)
                        <div class="min-w-[150px] bg-white rounded-2xl shadow-md p-2 flex-shrink-0 hover:shadow-lg transition duration-300">
                            <a href="{{ route('app.details', $similarApp->id) }}" class="block text-center">
                                <img src="{{ $similarApp->icon }}" alt="{{ $similarApp->name }}" class="w-full h-24 object-cover rounded-xl mb-2">
                                <p class="font-medium text-sm truncate">{{ $similarApp->name }}</p>
                                <div class="flex items-center justify-center mt-1">
                                    <span class="text-yellow-500 text-sm">★ {{ number_format($similarApp->average_rating, 1) }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <button onclick="scrollCarousel(-1)" class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 p-1 rounded-full shadow">⬅️</button>
                <button onclick="scrollCarousel(1)" class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 p-1 rounded-full shadow">➡️</button>
            </div>

            <div class="mt-4 flex items-center gap-2">
                <label class="text-sm">Sắp xếp theo:</label>
                <select id="sortSelect" onchange="sortSimilarApps()" class="border rounded-lg px-2 py-1 text-sm">
                    <option value="rating">Đánh giá cao</option>
                    <option value="downloads">Lượt tải nhiều</option>
                    <option value="name">Tên (A-Z)</option>
                </select>
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
</script>
