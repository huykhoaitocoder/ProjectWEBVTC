<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo"><a href="/developer/apps" class="simple-text logo-normal" style="margin-top: -20px;">
            <img src="{{ asset('images/logo-dev.png') }}" alt="VHAPK" width="150">
        </a>
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item">
        <a href="{{ route('developer.dashboard') }}" class="nav-link {{ Request::is('developer/dashboard') ? 'active' : '' }}">
          <i class="fas fa-tachometer-alt me-2"></i>
            <p>Tổng quan</p>
          </a>
        </li>
        <li class="nav-item">
        <a href="{{ route('developer.apps') }}" class="nav-link {{ request()->is('developer/apps*') ? 'active' : '' }}">
          <i class="fas fa-box me-2"></i>
            <p>Tất cả ứng dụng</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-chart-line me-2"></i>
            <p>Thống kê</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-star me-2"></i>
            <p>Đánh giá</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-dollar-sign me-2"></i>
            <p>Doanh thu</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('developer.coupons.index') }}" class="nav-link {{ request()->is('developer/coupons*') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i>
            <p>Mã Giảm Giá</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-envelope me-2"></i>
            <p>Lời Nhắn</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-comments me-2"></i>
            <p>Bình Luận</p>
          </a>
        </li>
        @if (Auth::user()->role =='developer')
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="fas fa-cog me-2"></i>
              <p>Cài đặt</p>
            </a>
          </li>
        @endif
        
        <li class="nav-item">
          <a href="/" class="nav-link">
            <i class="fas fa-sign-out-alt me-2"></i>
            <p> Thoát</p>
          </a>
        </li>  
      </ul>
    </div>
</div>

<style>
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 2;
  width: 260px;
  background: #fff;
  box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.sidebar .nav {
  margin-top: 20px;
  display: block;
}

.nav-link.active {
    background: #9c27b0 !important; 
    color: #fff !important;
    box-shadow: 0 4px 10px rgba(156, 39, 176, 0.5);
    font-weight: bold;
    border-radius: 5px;
}

.nav-link.active i {
  color: #fff !important;
}

.sidebar .nav li a:hover:not(.active) { background:rgb(215, 219, 217); }

.sidebar .nav li.active>a i {
  color: #fff;
}

.sidebar .nav p {
  margin: 0;
  line-height: 30px;
  font-size: 14px;
  position: relative;
  display: block;
  height: auto;
  white-space: nowrap;
}

.sidebar .nav i {
  font-size: 20px;
  float: left;
  margin-right: 15px;
  line-height: 30px;
  width: 30px;
  text-align: center;
}

.sidebar .nav li a {
  margin: 10px 15px 0;
  border-radius: 3px;
  color:rgb(122, 134, 142);
  padding-left: 10px;
  padding-right: 10px;
  text-transform: capitalize;
  font-size: 14px;
  padding: 10px 15px;
}

</style>
