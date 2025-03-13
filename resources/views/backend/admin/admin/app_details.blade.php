@extends('Backend.admin.layouts.master')

@section('title', 'Chi tiết ứng dụng')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Chi tiết ứng dụng
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('storage/' . $app->icon) }}" alt="Icon" class="img-fluid rounded" width="120">
                    </div>
                    <div class="col-md-9">
                        <h3>{{ $app->name }}</h3>
                        <p><strong>Danh mục:</strong> {{ $app->category->name ?? 'Không có' }}</p>
                        <p><strong>Developer:</strong> {{ $app->developer->name ?? 'Không rõ' }}</p>
                        <p><strong>Giá:</strong> {{ number_format($app->price, 0, ',', '.') }} VND</p>
                        <p><strong>Trạng thái:</strong>
                        <form action="{{ route('admin.update.status', $app->id) }}" method="POST" class="d-inline">
                            @method('POST')
                            @csrf
                            <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                                <option value="approved" {{ $app->status == 'approved' ? 'selected' : '' }}>Đang bán</option>
                                <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
                                <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Bị xoá</option>
                            </select>
                        </form>
                        </p>
                    </div>
                </div>

                <hr>
                <h5>Ảnh chụp màn hình</h5>
                <div class="row">
                    {{--
                    @foreach($app->screenshots as $screenshot)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset('storage/' . $screenshot->url) }}" class="img-fluid rounded">
                        </div>
                    @endforeach
--}}

                </div>

                <hr>
                <h5>Mô tả</h5>
                <p>{{ $app->description }}</p>
            </div>
        </div>
    </div>
@endsection
