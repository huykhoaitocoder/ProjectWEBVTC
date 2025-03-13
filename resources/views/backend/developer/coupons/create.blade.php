@extends('Backend.developer.layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
    <h2 class="mb-4 text-center">Tạo mã giảm giá</h2>
        <form action="{{ route('developer.coupons.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="app_id" class="form-label">Chọn ứng dụng:</label>
                <select name="app_id" class="form-control" required>
                    @foreach($apps as $app)
                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Nhập mã giảm giá:</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="discount_percentage" class="form-label">Giảm (%):</label>
                <input type="number" name="discount_percentage" class="form-control" min="1" max="100" required>
            </div>
            <div class="mb-3">
                <label for="max_usage" class="form-label">Số lượng sử dụng:</label>
                <input type="number" name="max_usage" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label for="expiration_date" class="form-label">Ngày hết hạn:</label>
                <input type="date" name="expiration_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo mã</button>
        </form>
    </div>
</div>
@endsection
