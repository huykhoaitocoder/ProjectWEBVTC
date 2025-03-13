<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid px-3">
        <a class="navbar-brand me-auto" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="VHAPK" width="150">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto" id="menu-items">
                <li class="nav-item"><a class="nav-link me-3 {{ Request::is('/apps') ? 'active' : '' }}" href="/apps">Ứng Dụng</a></li>
                <li class="nav-item"><a class="nav-link me-3 {{ Request::is('/games') ? 'active' : '' }}" href="/games">Trò Chơi</a></li>
                <li class="nav-item"><a class="nav-link me-3 {{ Request::is('/tools') ? 'active' : '' }}" href="/tools">Công Cụ</a></li>
            </ul>

            <form class="d-flex ms-3" id="search-form" method="GET" action="/search"> 
                <input id="search-input" name="query" class="form-control search-box" type="search" placeholder="Tìm kiếm ứng dụng..." aria-label="Search">
                <button id="search-icon" class="btn btn-outline-success ms-2" type="submit">Tìm</button>
            </form>

            @auth
                <div class="notification-container position-relative">
                    <a class="nav-link position-relative notification-trigger" href="#">
                        <i class="fa-solid fa-bell"></i>
                        @if(auth()->user()->unreadNotifications()->count())
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications()->count() }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                        @foreach(auth()->user()->notifications()->latest()->take(5)->get() as $notification)
                            <li>
                                <a class="dropdown-item {{ $notification->is_read ? '' : 'fw-bold' }}" href="{{ route('notifications.read', $notification->id) }}">
                                    {{ $notification->title }}
                                </a>
                            </li>
                        @endforeach
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('notifications.index') }}">Xem tất cả</a></li>
                    </ul>
                </div>
            @endauth

            <div class="navbar-user ms-3 position-relative">
                @auth
                    <div class="user-dropdown">
                        <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/user-icon.png') }}" 
                             alt="User" width="30" class="rounded-circle user-avatar">
                        <div class="dropdown-menu shadow">
                            <div class="p-3 text-center">
                                <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/user-icon.png') }}" 
                                     alt="Avatar" width="60" class="rounded-circle mb-2">
                                <p class="mb-1 fw-bold">{{ Auth::user()->name }}</p>
                                @if (Auth::check() && Auth::user()->role === 'developer')
                                    <a href="/developer/apps" class="btn btn-sm btn-outline-primary w-100 mb-2">Trang nhà phát triển</a>
                                @endif
                                <a href="/profile" class="btn btn-sm btn-outline-primary w-100 mb-2">Trang cá nhân</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Đăng xuất</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="/login" title="Đăng nhập">
                        <img src="{{ asset('images/user-icon.png') }}" alt="User" width="30" class="rounded-circle">
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>