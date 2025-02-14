@extends('layouts.main')

@section('title', 'Trang Chủ')

@section('content')
    <div class="home-container">
        <div class="welcome-section">
            <h1>Chào mừng đến với Website của chúng tôi!</h1>
            <p>Khám phá những tính năng hữu ích và trải nghiệm dịch vụ tuyệt vời.</p>

            @if(Auth::check())
                <a href="{{ route('dashboard') }}" class="btn-primary">Vào Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-secondary">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login.form') }}" class="btn-primary">Đăng nhập</a>
                <a href="{{ route('register.form') }}" class="btn-secondary">Đăng ký</a>
            @endif

        </div>
    </div>

    <style>
        .home-container {
            text-align: center;
            margin-top: 50px;
        }

        .welcome-section h1 {
            font-size: 2.5em;
            color: #2c3e50;
        }

        .welcome-section p {
            color: #7f8c8d;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .btn-primary, .btn-secondary {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #3498db;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2980b9;
        }
    </style>
@endsection
