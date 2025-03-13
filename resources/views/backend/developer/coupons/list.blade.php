@extends('Backend.developer.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Danh sách mã giảm giá</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('developer.coupons.create') }}" class="btn btn-primary">
            <i class="fas fa-filter"></i> Bộ lọc
        </a>
        <a href="{{ route('developer.coupons.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tạo mã mới
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Giảm giá</th>
                    <th>Số lần sử dụng</th>
                    <th>Đã sử dụng</th>
                    <th>Ngày hết hạn</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->discount_percentage }}%</td>
                        <td>{{ $coupon->max_usage }}</td>
                        <td>{{ $coupon->used_count }}</td>
                        <td>{{ $coupon->expiration_date->format('d/m/Y') }}</td>
                        <td>{{ $coupon->status }}</td>
                        <td class="d-flex gap-2">
                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Chi tiết
                            </a>
                            <form action="{{ route('developer.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
