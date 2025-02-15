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
                    <div class="card h-100">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>Giá: </strong>{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
