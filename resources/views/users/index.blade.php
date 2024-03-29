@extends('layouts.app')

@section('content')

    {{-- ユーザ一覧 --}}
    @include('users.users')

    <a href="{{ route('users.friends', auth()->id()) }}" class="tab tab-lifted grow {{ Request::routeIs('users.friends') ? 'tab-active' : '' }}">
        友達申請をしているユーザー
    </a>

    <a href="{{ route('users.friendRequests', auth()->id()) }}" class="tab tab-lifted grow {{ Request::routeIs('users.friendRequests') ? 'tab-active' : '' }}">
        友達申請をくれたユーザー
    </a>

@endsection