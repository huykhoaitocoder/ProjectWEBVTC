@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="img-fluid rounded app-icon">
            </div>
            
            <div class="col-md-8">
                <h2 class="fw-bold">{{ $app->name }}</h2>
                <p class="text-muted">Nhà phát triển: <strong>{{ $app->developer->name ?? 'Không rõ' }}</strong></p>
                <p>Danh mục: <span class="badge bg-primary">{{ $app->category->name ?? 'Không rõ' }}</span></p>
                <p>Lượt tải xuống: <strong>{{ number_format($app->total_downloads) }}</strong></p>
                <p>Đánh giá trung bình: <strong>{{ $app->average_rating }}/5 ⭐</strong></p>
                
                <h4 class="mt-3 {{ $app->price > 0 ? 'text-danger' : 'text-success' }}">
                    {{ $app->price > 0 ? number_format($app->price, 2) . ' VNĐ' : 'Miễn phí' }}
                </h4>

                @if($app->price > 0)
                    @if($userHasPurchased)
                        <!-- Nếu đã mua, hiển thị nút "Tải lại" -->
                        <a href="#" class="btn btn-lg btn-primary mt-3">Tải xuống lại</a>
                    @else
                        <!-- Nếu chưa mua, hiển thị nút "Mua" -->
                        <a href="#" class="btn btn-lg btn-warning mt-3">Mua</a>
                    @endif
                @else
                    <!-- Nếu ứng dụng miễn phí, hiển thị nút "Tải xuống" -->
                    <a href="#" class="btn btn-lg btn-success mt-3">Tải xuống</a>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <h4>Mô tả</h4>
            <p>{{ $app->description }}</p>
        </div>
    </div>
</div>
@endsection
