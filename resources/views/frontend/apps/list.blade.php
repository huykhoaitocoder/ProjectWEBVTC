@extends('frontend.layout')

@section('content')
<div class="container my-4">
    <div id="app-list" class="row row-cols-2 row-cols-md-4 row-cols-lg-8 g-3">
        @foreach($apps as $app)
            <div class="col">
                <div class="app-item text-center p-2 border rounded h-100">
                    <a href="{{ route('app.details', $app->id) }}" class="text-decoration-none">
                        <img src="{{ asset($app->icon) }}" alt="{{ $app->name }}" class="app-icon mb-2" style="width:105px; height:105px;">
                        <p class="app-name mb-1" style="font-size:14px;">{{ $app->name }}</p>
                        <small class="text-start">{{ $app->developer->name ?? 'Không rõ' }}</small>
                        <p class="app-rating text-warning mt-1">{{ number_format($app->average_rating, 1) }} ⭐</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div id="loading" class="text-center my-3" style="display:none;">
        <span>Đang tải...</span>
    </div>
</div>
@endsection

@push('scripts')
<script>
let offset = 3;
const keyword = @json($keyword);
let isLoading = false;

function loadMoreApps() {
    if (isLoading) return;
    isLoading = true;
    $("#loading").show();

    $.ajax({
        url: "{{ route('search.loadMore') }}",
        method: "GET",
        data: { query: keyword, offset: offset },
        success: function (apps) {
            if (apps.length > 0) {
                apps.forEach(app => {
                    $('#app-list').append(`
                        <div class="app-item border rounded p-2 my-2">
                            <h5>${app.title}</h5>
                            <p>${app.description.substring(0, 100)}...</p>
                            <small>Lượt tải: ${app.downloads}</small>
                        </div>
                    `);
                });
                offset += 10;
            }
        },
        complete: function () {
            $("#loading").hide();
            isLoading = false;
        }
    });
}

$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        loadMoreApps();
    }
});
</script>
@endpush
