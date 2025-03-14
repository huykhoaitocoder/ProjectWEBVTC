@extends('Backend.admin.layouts.master')

@section('title', 'Quản lý người dùng')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Quản lý người dùng</h2>

        <!-- Thanh công cụ tìm kiếm và bộ lọc -->
        <div class="d-flex justify-content-between mb-3">
            <form class="d-flex" method="GET" action="{{ route('admin.users.management.index') }}">
                <input class="form-control me-2" type="text" name="search"
                       placeholder="Nhập tên hoặc email..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>

            <!-- Bộ lọc theo vai trò -->
            <div>
                <a href="{{ route('admin.users.management.index', ['role' => 'admin']) }}" class="btn btn-danger btn-sm">Admin</a>
                <a href="{{ route('admin.users.management.index', ['role' => 'developer']) }}" class="btn btn-warning btn-sm">Developer</a>
                <a href="{{ route('admin.users.management.index', ['role' => 'user']) }}" class="btn btn-success btn-sm">User</a>
                <a href="{{ route('admin.users.management.index', ['role' => 'banned']) }}" class="btn btn-secondary btn-sm">Banned</a>
                <a href="{{ route('admin.users.management.index') }}" class="btn btn-dark btn-sm">Tất cả</a>
            </div>
        </div>

        <!-- Bảng danh sách người dùng -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Danh sách người dùng
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $user->avatar ?? asset('default-avatar.png') }}"
                                     alt="Avatar" width="50" height="50" class="rounded-circle">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{route('admin.user.details',$user->id)}}">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                <span class="badge
                                    {{ $user->role == 'admin' ? 'bg-danger' :
                                       ($user->role == 'dev' ? 'bg-warning' :
                                       ($user->role == 'user' ? 'bg-success' : 'bg-secondary')) }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{route('admin.user.update.role',$user->id)}}" method="POST">
                                    @csrf
                                    <select name="role" class="form-select d-inline w-auto" onchange="this.form.submit()">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="dev" {{ $user->role == 'dev' ? 'selected' : '' }}>Developer</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="ban" {{ $user->role == 'ban' ? 'selected' : '' }}>Banned</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có người dùng nào phù hợp</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Phân trang -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@endsection
