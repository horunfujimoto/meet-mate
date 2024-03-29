
@extends('layouts.app')

@section('content')
    <h1>ページ遷移用</h1>
    <a href="{{ route('users.index') }}">ユーザ一覧</a>
    <a href="{{ route('myfriends.index') }}">友達一覧</a>
    <a href="{{ route('match_users.index') }}">出会った方一覧</a>
    <a href="{{ route('match_users.create') }}">出会った方の登録</a>
    <a href="{{ route('posts.index') }}">みんなの投稿一覧</a>
    <a href="{{ route('posts.create') }}">投稿</a>
    
@endsection
