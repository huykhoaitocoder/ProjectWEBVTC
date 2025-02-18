<div class="col-md-2 col-6 mb-3">
    <div class="card text-center shadow-sm">
        <img src="{{ $app->icon }}" class="card-img-top p-2" alt="{{ $app->name }}">
        <div class="card-body">
            <h6 class="card-title text-truncate">{{ $app->name }}</h6>
            <p class="text-muted small">
                @if($app->price > 0)
                    {{ number_format($app->price, 0) }} VNĐ
                @else
                    Miễn phí
                @endif
            </p>
            <a href="#" class="btn btn-sm btn-primary">Tải ngay</a>
        </div>
    </div>
</div>
