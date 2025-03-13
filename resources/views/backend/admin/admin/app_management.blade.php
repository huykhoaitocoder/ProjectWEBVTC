@extends('Backend.admin.layouts.master')

@section('title', 'Quản lý ứng dụng')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Quản lý ứng dụng</h2>

        <!-- Thanh công cụ tìm kiếm và bộ lọc -->
        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex" method="GET" action="{{ route('admin.apps.index') }}">
                <input class="form-control me-2" type="text" name="search"
                       placeholder="Nhập tên ứng dụng..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>

            <!-- Bộ lọc trạng thái -->
            <div>
                <a href="{{ route('admin.apps.index', ['status' => 'approved']) }}" class="btn btn-success btn-sm">
                    Ứng dụng đang hoạt động
                </a>
                <a href="{{ route('admin.apps.index', ['status' => 'pending']) }}" class="btn btn-warning btn-sm">
                    Đang chờ phê duyệt
                </a>
                <a href="{{ route('admin.apps.index', ['status' => 'rejected']) }}" class="btn btn-danger btn-sm">
                    Ứng dụng bị xoá
                </a>
                <a href="{{ route('admin.apps.index') }}" class="btn btn-secondary btn-sm">Tất cả</a>
            </div>
        </div>

        <!-- Bảng danh sách ứng dụng -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Danh sách ứng dụng
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
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
                        <tr>
                            <td>{{ $apps->firstItem() + $index }}</td>
                            <td>
                                <img src="{{$app->icon}}" alt="Icon" width="40" height="40" class="rounded">
                            </td>
                            <td>
                                <a href="{{ route('admin.app.details', ['id' => $app->id]) }}">
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
@endsection
