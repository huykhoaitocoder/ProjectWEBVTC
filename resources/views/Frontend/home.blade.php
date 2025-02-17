@extends('Backend.layouts.main')

@section('title', 'Trang Chủ')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary">Chào mừng đến với Chợ Phần Mềm</h1>
            <p class="lead">Khám phá những phần mềm chất lượng giúp tối ưu hóa công việc và giải trí của bạn.</p>

            @if(Auth::check())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success me-2">Vào Dashboard</a>

                <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-danger">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('admin.login.show') }}" class="btn btn-primary me-2">Đăng nhập</a>
                <a href="{{ route('admin.register.show') }}" class="btn btn-outline-secondary">Đăng ký</a>
            @endif
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4 overflow-hidden">
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $product->video_url }}" allowfullscreen></iframe>
                        </div>
                        <div class="card-body d-flex flex-row align-items-start">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-1">{{ $product->name }}</h6>
                                <p class="small mb-1">Giá: {{ number_format($product->price, 0, ',', '.') }} VND</p>
                                <p class="small mb-1">{{ $product->description }}</p>
                                <p class="small text-warning mb-0">&#9733; {{ $product->rating }}</p>
                            </div>
                            <button onclick="main.addToCart({{ $product->id }},'{{ $product->name }}','{{ $product->icon }}',{{ $product->price }})" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <style>
        .pagination .page-link {
            font-size: 14px;
            padding: 6px 10px;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@endsection
