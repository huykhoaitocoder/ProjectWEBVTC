@extends('Backend.developer.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Tất cả ứng dụng của tôi</h2>
    <a href="{{ route('developer.apps.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tạo ứng dụng
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Biểu tượng</th>
                    <th>Tên ứng dụng</th>
                    <th>Gói</th>
                    <th>Lượt tải</th>
                    <th>Đánh giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apps as $index => $app)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><img src="{{ $app->icon }}" width="40" class="rounded"></td>
                    <td>{{ $app->name }}</td>
                    <td>{{ $app->package_name }}</td>
                    <td>{{ number_format($app->total_downloads) }}</td>
                    <td>
                        <span class="badge bg-success">
                            <i class="fas fa-star"></i> {{ number_format($app->average_rating, 1) }}
                        </span>
                    </td>
                    <td>
                        @if($app->status === 'approved')
                            <span class="badge bg-success">Đã duyệt</span>
                        @elseif($app->status === 'pending')
                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                        @else
                            <span class="badge bg-danger">Bị từ chối</span>
                        @endif
                    </td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa ứng dụng này?')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
