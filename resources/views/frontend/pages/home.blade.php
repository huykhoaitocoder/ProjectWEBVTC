@extends('frontend.layout')

@section('content')

<div id="homepageSlider" class="carousel slide container" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $key => $slider)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <a href="{{ $slider->link ?? '#' }}">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="{{ $slider->title }}">
                </a>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homepageSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homepageSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<!-- <div class="container mt-4">
    <div class="row text-center">
        @foreach($categories as $category)
            <div class="col-md-2 col-4 mb-3">
                <a href="#" class="text-decoration-none text-dark">
                    <div class="border p-3 rounded shadow-sm">
                        <strong>{{ $category->name }}</strong>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div> -->

<div class="container mt-5">
    @php
        $sections = [
            ['title' => '📈 Ứng dụng phổ biến', 'apps' => $topApps],
            ['title' => '🆕 Ứng dụng mới nhất', 'apps' => $newApps],
            ['title' => '🎉 Ứng dụng miễn phí', 'apps' => $freeApps],
            ['title' => '💰 Ứng dụng trả phí', 'apps' => $paidApps],
            ['title' => '⭐ Ứng dụng đánh giá cao', 'apps' => $topRatedApps],
        ];
    @endphp

    @foreach($sections as $section)
        @if($section['apps']->count() > 0)
            <h3 class="mt-4 mb-3">{{ $section['title'] }}</h3>
            <div class="app-list">
                @foreach($section['apps'] as $app)
                    <div class="app-item">
                        <a href="{{ route('app.details', $app->id) }}">
                            <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="app-icon">
                            <p class="app-name">{{ $app->name }}</p>
                            <!-- <p class="app-category">{{ $app->category->name }}</p> -->
                            <p class="app-rating">{{ number_format($app->average_rating, 1) }}<i class="fa fa-star" style="font-size:12px; position: relative; top: -1px;"></i></p>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>