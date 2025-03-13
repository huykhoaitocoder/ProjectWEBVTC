@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-3">Duyệt tài khoản Developer</h2>

    @foreach ($developers as $developer)
        <div class="card p-3 mb-3">
            <p><strong>Công ty:</strong> {{ $developer->company_name }}</p>
            <p><strong>Email:</strong> {{ $developer->user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $developer->phone }}</p>
            <form action="{{ route('admin.developers.approve', $developer->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Duyệt</button>
            </form>
            <form action="{{ route('admin.developers.reject', $developer->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Từ chối</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
