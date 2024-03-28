@extends('layouts.app')

@section('content')
    <div class="prose ml-4 mt-8">
        <h2>{{ $match_user->name }} さんの詳細ページ</h2>
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
    
    {{-- 一覧ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('match_users.index') }}">出会った方一覧</a>
    {{-- 編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('match_users.edit', $match_user->id) }}">編集</a>
    {{-- 削除フォーム --}}
    <form method="POST" action="{{ route('match_users.destroy', $match_user->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('削除してもよろしいですか？')">削除</button>
    </form>
@endsection