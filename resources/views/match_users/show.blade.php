@extends('layouts.app')

@section('content')
    <div class="prose ml-4 mt-8">
        <h2>{{ $match_user->name }} の詳細</h2>
    </div>

    <div class="flex justify-center">
        <div>
            <p>名前: {{ $match_user->name }}</p>
            <p>住んでいる場所: {{ $match_user->address }}</p>
            <p>職業: {{ $match_user->work }}</p>
            <p>誕生日: {{ $match_user->birthday }}</p>
            <p>SNS: {{ $match_user->sns }}</p>
            <p>出会い方: {{ $match_user->way }}</p>
            <p>その他: {{ $match_user->others }}</p>
            <p>画像:</p>
            <img src="{{ $match_user->image }}" alt="{{ $match_user->name }}" width="100">
        </div>
    </div>
@endsection