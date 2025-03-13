@extends('frontend.layout')

@section('content')
<div class="container">
    <div class="game-carousel-container">
        <h4 class="section-title">Trò Chơi Nổi Bật</h4>
        <div class="game-carousel">
            @foreach($games as $game)
            <!-- sua dong sau background app -->
                <div class="game-card" style="background-image: url('{{ asset($game->icon) }}');"> 
                    <!-- <div class="badge">{{ $game->badge_text ?? 'Theo các biên tập viên' }}</div> -->
                    <div class="game-info">
                        <h5 class="title">{{ $game->name }}</h5>
                        <!-- <p class="subtitle">{{ $game->description }}</p> -->
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

    <div class="games-list-container">
        <h4 class="section-title">Trò Chơi Nổi Bật</h4>
        <div class="games-list">
            @foreach($games as $game)
            <div class="games-item">
                <img src="{{ asset($game->icon) }}" alt="{{ $game->name }}" class="games-icon">
                <div class="games-details">
                    <h5 class="games-title">{{ $game->name }}</h5>
                    <span class="games-developer">{{ $game->developer->name }}</span>
                    <div class="games-rating">
                        <span class="rating-score">{{ number_format($game->average_rating, 1) }}</span>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="games-carousel-container">
        <h4 class="section-title">Trò Chơi Nổi Bật</h4>
        <div class="games-carousel">
            @foreach($games as $game)
            <div class="games-card-wrapper">
                <div class="games-media-box">
                    @if(!empty($game->versions[0]->video))
                        <video controls class="games-media">
                            <source src="{{ asset($game->versions[0]->video) }}" type="video/mp4">
                        </video>
                    @elseif(optional(optional($game->versions->first())->screenshots)[0] ?? false)
                        <img src="{{ asset(optional($game->versions->first())->screenshots[0]) }}" alt="Screenshot" class="games-media">
                    @endif
                </div>

                <div class="games-card"> 
                    <div class="games-info-box">
                        <h5 class="title">{{ $game->name }}</h5>
                        <div class="games-meta">
                            <img src="{{ asset($game->icon) }}" alt="{{ $game->title }}" class="games-icon">
                            <div>
                                <span class="developer">{{ $game->developer->name }}</span>
                                <span class="age-rating">{{ number_format($game->average_rating, 1) }}<i class="fa fa-star" style="font-size:10px; position: relative; top: -1px; left: 1px"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

<style>
/* 1 */
.game-carousel-container {
    margin: 30px 0;
}

.section-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 15px;
}

.game-carousel {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding-bottom: 10px;
    scroll-snap-type: x mandatory;
}

.game-card {
    position: relative;
    /* flex: 1 1 calc(33.33% - 10px); 3 cột trên 1 dòng */
    width: calc(33.33% - 10px);
    height: 270px;
    border-radius: 15px;
    background-size: cover;
    background-position: center;
    flex-shrink: 0;
    scroll-snap-align: start;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 15px;
    overflow: hidden;
    object-fit: cover;
}

.game-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    border-radius: 15px;
    z-index: 1;
}

.badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.6);
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    z-index: 2;
}

.game-info {
    position: relative;
    z-index: 2;
}

.title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 5px;
}

.subtitle {
    font-size: 14px;
    opacity: 0.9;
    margin-bottom: 10px;
}

.game-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}

.game-icon {
    width: 35px;
    height: 35px;
    border-radius: 10px;
}

.developer, .age-rating {
    font-size: 12px;
    display: block;
    opacity: 0.9;
}

.install-btn {
    background: rgba(255, 255, 255, 0.9);
    color: black;
    border: none;
    padding: 5px 15px;
    font-size: 14px;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.install-btn:hover {
    background: rgba(255, 255, 255, 1);
}
 /* 2 */
.games-list-container {
    padding-bottom: 40px;
}
.section-title {
    font-size: 1.5rem;
    margin-bottom: 15px;
}
.games-list {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}
.games-item {
    display: flex;
    align-items: center;
    width: calc(33.33% - 10px);
    background: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.games-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    margin-right: 10px;
}
.games-details {
    display: flex;
    flex-direction: column;
}
.games-title {
    font-size: 1rem;
    font-weight: bold;
}
.games-developer {
    font-size: 0.9rem;
    color: gray;
}
.games-rating {
    display: flex;
    align-items: center;
    color: orange;
    font-weight: bold;
}
.fa-star {
    font-size: 12px;
    margin-left: 3px;
}

/* 3 */
.games-carousel {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 25px; 
}

.games-card-wrapper {
    flex: 1 1 calc(33.33% - 20px);
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: calc(33.33% - 20px);
}

.games-media-box {
    width: 100%;
    height: 250px; 
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.games-media {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo ảnh/video không bị méo */
}

.games-card {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    width: 100%;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.games-info-box {
    width: 100%;
}

.games-meta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

@media (max-width: 992px) { /* Responsive cho màn hình nhỏ */
    .game-card-wrapper {
        flex: 1 1 calc(50% - 15px); /* 2 game trên một hàng */
        max-width: calc(50% - 15px);
    }
}

@media (max-width: 600px) {
    .game-card-wrapper {
        flex: 1 1 100%; 
        max-width: 100%;
    }
}
</style>