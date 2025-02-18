<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="APKRebel" width="150">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto" id="menu-items">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ứng Dụng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Trò Chơi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Bản Mod</a>
                </li>
            </ul>

            <form class="d-flex ms-3" id="search-form">
                <input id="search-input" class="form-control search-box" type="search" placeholder="Tìm kiếm ứng dụng..." aria-label="Search">
                <button id="search-icon" class="btn btn-outline-success ms-2" type="submit">Tìm</button>
            </form>

            <div class="navbar-user ms-3">
                <a href="/login">
                    <img src="{{ asset('images/user-icon.png') }}" alt="User" width="30" class="rounded-circle">
                </a>
            </div>
        </div>
    </div>
</nav>
