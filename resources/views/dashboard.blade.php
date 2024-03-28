
@extends('layouts.app')

@section('content')
    <h1>ページ遷移用</h1>
    <a href="{{ route('users.index') }}">ユーザ一覧</a>
    <a href="{{ route('match_users.index') }}">出会った方一覧</a>
    
    
@endsection
