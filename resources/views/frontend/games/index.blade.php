@extends('frontend.layout')

@section('content')
<div class="game-carousel-container">
    <h4 class="section-title">Trò Chơi Nổi Bật</h4>
    <div class="game-carousel">
        @foreach($games as $game)
        <!-- sua dong sau background app -->
            <div class="game-card" style="background-image: url('{{ asset($game->icon) }}');"> 
                <!-- <div class="badge">{{ $game->badge_text ?? 'Theo các biên tập viên' }}</div> -->
                <div class="game-info">
                    <h5 class="title">{{ $game->name }}</h5>
                    <p class="subtitle">{{ $game->description }}</p>
                    <div class="game-meta">
                        <img src="{{ asset($game->icon) }}" alt="{{ $game->title }}" class="game-icon">
                        <div>
                            <span class="developer">{{ $game->developer->name }}</span>
                            <span class="age-rating">{{ number_format($game->average_rating, 1) }}<i class="fa fa-star" style="font-size:10px; position: relative; top: -1px; left: 1px"></i></span>
                        </div>
                    </div>
                    <button class="install-btn">Cài đặt</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection