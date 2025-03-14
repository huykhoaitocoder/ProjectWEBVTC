@extends('Backend.admin.layouts.master')

@section('title', 'Chi tiết người dùng')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4>Thông tin chi tiết</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Ảnh đại diện -->
                    <div class="col-md-3 text-center">
                        <img src="{{ $user->avatar ?? asset('default-avatar.png') }}"
                             class="rounded-circle img-thumbnail"
                             alt="Avatar" width="150">
                    </div>

                    <!-- Thông tin user -->
                    <div class="col-md-9">
                        <h3 class="text-primary">{{ $user->name }}</h3>
                        <p><strong>Email:</strong> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        <p><strong>Vai trò:</strong>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif($user->role == 'dev')
                                <span class="badge bg-warning">Developer</span>
                            @elseif($user->role == 'user')
                                <span class="badge bg-success">User</span>
                            @else
                                <span class="badge bg-secondary">Bị khóa</span>
                            @endif
                        </p>
                        <p><strong>Ngày tạo tài khoản:</strong> {{ $user->created_at->format('d/m/Y') }}</p>

                        <!-- Form cập nhật vai trò -->
                        <form action="{{ route('admin.user.update.role', $user->id) }}" method="POST" class="mt-3">
                            @csrf
                            <label for="role">Thay đổi vai trò:</label>
                            <select name="role" id="role" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="dev" {{ $user->role == 'developer' ? 'selected' : '' }}>Developer</option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="ban" {{ $user->role == 'banned' ? 'selected' : '' }}>Bị khóa</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
