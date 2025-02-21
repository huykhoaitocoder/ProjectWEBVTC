@extends('frontend.layout')

@section('content')
<div class="container">
    <h4>Thông báo</h4>
    <ul class="list-group">
        @foreach($notifications as $notification)
            <li class="list-group-item {{ $notification->is_read ? '' : 'fw-bold' }}">
                <a href="{{ route('notifications.read', $notification->id) }}">
                    {{ $notification->title }} - {{ $notification->message }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
