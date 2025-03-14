@extends('Backend.admin.layouts.master')

@section('title', 'Quản lý ứng dụng')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4 text-primary fw-bold text-gradient text-start">Quản lý ứng dụng</h2>

        <!-- Thanh công cụ tìm kiếm và bộ lọc -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form class="d-flex shadow-sm rounded p-2 bg-light" method="GET" action="{{ route('admin.apps.index') }}">
                <input class="form-control me-2 border-0" type="text" name="search"
                       placeholder="Nhập tên ứng dụng..." value="{{ request('search') }}">
                <button class="btn btn-primary shadow" type="submit">Tìm kiếm</button>
            </form>

            <!-- Bộ lọc trạng thái -->
            <div class="btn-group shadow-sm" role="group">
                <a href="{{ route('admin.apps.index', ['status' => 'approved']) }}" class="btn btn-success btn-sm">Đang hoạt động</a>
                <a href="{{ route('admin.apps.index', ['status' => 'pending']) }}" class="btn btn-warning btn-sm">Chờ duyệt</a>
                <a href="{{ route('admin.apps.index', ['status' => 'rejected']) }}" class="btn btn-danger btn-sm">Bị xoá</a>
                <a href="{{ route('admin.apps.index') }}" class="btn btn-secondary btn-sm">Tất cả</a>
            </div>
        </div>

        <!-- Bảng danh sách ứng dụng -->
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-gradient text-white fw-bold">Danh sách ứng dụng</div>
            <div class="card-body">
                <table class="table table-hover align-middle text-start">
                    <thead class="bg-gradient text-white">
                    <tr>
                        <th>#</th>
                        <th>Icon</th>
                        <th>Tên ứng dụng</th>
                        <th>Danh mục</th>
                        <th>Developer</th>
                        <th>Lượt tải</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($apps as $index => $app)
                        <tr class="table-row">
                            <td>{{ $apps->firstItem() + $index }}</td>
                            <td>
                                <img src="{{$app->icon}}" alt="Icon" width="40" height="40" class="rounded-circle shadow-sm">
                            </td>
                            <td>
                                <a href="{{ route('admin.app.details', ['id' => $app->id]) }}" class="text-decoration-none fw-bold text-dark hover-primary">
                                    {{ $app->name }}
                                </a>
                            </td>
                            <td>{{ $app->category->name ?? 'Không có' }}</td>
                            <td>{{ $app->developer->name ?? 'Không rõ' }}</td>
                            <td>{{ $app->downloads_count }}</td>
                            <td>
                                @if($app->status == 'approved')
                                    <span class="badge bg-success">Đang hoạt động</span>
                                @elseif($app->status == 'pending')
                                    <span class="badge bg-warning">Chờ duyệt</span>
                                @else
                                    <span class="badge bg-danger">Bị xoá</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.update.status', $app->id) }}" method="POST" class="d-inline">
                                    @method('POST')
                                    @csrf
                                    <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                                        <option value="approved" {{ $app->status == 'approved' ? 'selected' : '' }}>Đang bán</option>
                                        <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
                                        <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Bị xoá</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Không có ứng dụng nào phù hợp</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-3">
            {{ $apps->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <style>
        .text-gradient {
            background: linear-gradient(45deg, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient {
            background: linear-gradient(90deg, #007bff, #6610f2);
        }
        .hover-primary:hover {
            color: #007bff !important;
        }
        .table-row:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease-in-out;
        }
    </style>
@endsection
