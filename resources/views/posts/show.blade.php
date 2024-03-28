@extends('layouts.app')

@section('content')
    <div class="prose ml-4 mt-8">
        <h2>{{ $post->title }}の詳細ページ</h2>
    </div>

    <div class="flex justify-center">
        <div>
            <p>投稿者: {{ $user->name }}</p>
            <p>会った方: {{ $match_user->name }}</p>
            <p>タイトル: {{ $post->title }}</p>
            <p>会った日: {{ $post->date_day }}</p>
            <p>会った場所: {{ $post->place }}</p>
            <p>内容: {{ $post->body }}</p>
            <p>画像:</p>
            <img src="{{ $post->image }}" alt="{{ $post->name }}" width="100">
        </div>
    </div>
    
    {{-- 一覧ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('posts.index') }}">みんなの投稿一覧</a>
    {{-- 編集ページへのリンク --}}
    <a class="btn btn-outline" href="{{ route('posts.edit', $post->id) }}">編集</a>
    {{-- 削除フォーム --}}
    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn btn-error btn-outline" 
            onclick="return confirm('削除してもよろしいですか？')">削除</button>
    </form>
@endsection