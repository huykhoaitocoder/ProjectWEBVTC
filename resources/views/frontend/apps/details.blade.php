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

            <div class="d-flex align-items-center mb-2">
                <span class="badge bg-success me-2">Ứng dụng đáng tin cậy</span>
            </div>

            <div class="d-flex align-items-center">
                <span class="me-3">
                    <strong>{{ number_format($app->average_rating, 1) }}</strong> ⭐
                </span>
                <span>{{ $app->reviews_count ?? 0 }} Đánh giá</span>
            </div>
        </div>
        <div class="col-md-3 text-end">
            <a href="#" class="btn btn-lg btn-success w-100">
                <i class="bi bi-download"></i> Tải về APK
            </a>
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
            <p class="fw-bold mb-0">{{ number_format($app->average_rating, 1) }}</p>
            <small>{{ $app->reviews_count ?? 0 }} Đánh giá</small>
        </div>
        <div class="col-md-4">
            <p class="fw-bold mb-0">{{ $app->updated_at ? $app->updated_at->format('M d, Y') : 'Không xác định' }}</p>
            <small>Ngày cập nhật</small>
        </div>
        <div class="col-md-4">
            <p class="fw-bold mb-0">Android {{ $app->min_android_version ?? '4.4+' }}</p>
            <small>Android OS</small>
        </div>
    </div>

    <div class="card shadow-lg p-4">        
        <h4 class="mt-5">Ảnh chụp màn hình</h4>
        <div class="d-flex overflow-auto gap-3">
            @foreach($app->screenshots as $screenshot)
                <img src="{{ asset($screenshot->url) }}" alt="Screenshot" class="rounded" style="height:200px;">
            @endforeach
        </div>

        <h4 class="mt-5">Phiên bản cũ của {{ $app->name }}</h4>
        <ul class="list-group">
            @foreach($app->versions as $version)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $version->version_name }}</strong> - {{ $version->size }} MB  
                        <br><small>Cập nhật: {{ $version->created_at?->format('M d, Y') ?? 'Không rõ' }}</small>
                    </div>
                    <a href="{{ $version->download_link }}" class="btn btn-success">Tải về</a>
                </li>
            @endforeach
        </ul>

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
                    <strong>Yêu cầu Android</strong>
                    <div>Android {{ $app->min_android_version ?? 'Không rõ' }}</div>
                </div>
            </div>

            <div class="col">
                <div class="border p-3 rounded">
                    <strong>Available on</strong>
                    <div>
                        @if($app->google_play_link)
                            <a href="{{ $app->google_play_link }}" target="_blank">
                                <img src="{{ asset('images/google-play-badge.png') }}" alt="Google Play" height="40">
                            </a>
                        @else
                            Không có
                        @endif
                    </div>
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
                    <strong>Báo cáo</strong>
                    <div>
                        <a href="{{ route('frontend.report', $app->id) }}" class="text-danger">
                            Gắn cờ là không phù hợp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--
        <!-- Đánh giá người dùng, da cmt -->
        <h2>Đánh giá của người dùng</h2>
        <div class="rating-summary">
            <div class="average-rating">{{ number_format($app->average_rating, 1) }}</div>
            <p>{{ $app->reviews->count() }} Đánh giá</p>
        </div>
        @foreach ($app->reviews as $review)
            <div class="review">
                <strong>{{ $review->user->name }}</strong>
                <span>{{ $review->created_at->format('Y-m-d') }}</span>
                <p>{{ $review->comment }}</p>
                <p>Đánh giá: {{ $review->rating }} ⭐</p>
            </div>
        @endforeach
        --}}

        {{--
        <div class="similar-games-section">
            <h2 class="text-2xl font-semibold mb-4">Các trò chơi như {{ $app->name }}</h2>
            <div class="relative">
                <div id="similar-games-carousel" class="flex overflow-x-auto gap-4 scroll-smooth pb-2">
                    @foreach($similarApps as $similarApp)
                        <div class="min-w-[150px] bg-white rounded-2xl shadow-md p-2 flex-shrink-0 hover:shadow-lg transition duration-300">
                            <a href="{{ route('apps.show', $similarApp->id) }}" class="block text-center">
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
        --}}
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
