@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2 class="title">{{ $post->title }}の詳細ページ</h2>
                <h4 class="status">{{ $post->status }}</h4>
            </div>
        </div>
        
        <div class="row m-2">
            <div class="col-md-4">
                <div class="mt-4">
                    <img src="/images/{{ $post->image }}" alt="{{ $post->name }}" class="img-fluid" width="200">
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="mt-4">
                    <p>投稿者: {{ $user->name }}</p>
                    <p>会った方: {{ $match_user->name }}</p>
                    <p>タイトル: {{ $post->title }}</p>
                    <p>会った日: {{ $post->date_day }}</p>
                    <p>会った場所: {{ $post->place }}</p>
                    <p>内容: {{ $post->body }}</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="edit-delete favorite mt-4 text-center">
                    @if (Auth::id() == $post->user_id)
                        {{-- 編集ページへのリンク --}}
                        <div class="d-inline-block mr-2">
                            <a class="btn " href="{{ route('posts.edit', $post->id) }}" style="background-color: #FF6699; color: white; font-size: 1.2rem;"><i class="fa-regular fa-pen-to-square"></i></a>
                        </div>
                        {{-- 削除フォーム --}}
                        <div class="d-inline-block mr-2">
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" class="my-2">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn" onclick="return confirm('削除してもよろしいですか？')" style="background-color: #FF6699; color: white; font-size: 1.2rem;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @else
                        <div>
                            {{-- いいね --}}
                            @include('favorites.favorite_button')
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="comment">
                {{-- コメントフォーム --}}
                @include('comments.form')
                {{-- コメント一覧 --}}
                @include('comments.comments')
            </div>
        </div>
        
    </div>
@endsection