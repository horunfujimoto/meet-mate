@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2 class="title">{{ $post->title }}の詳細ページ({{ $post->status }})</h2>
                @if ($post->status === '限定公開')
                    <p>閲覧可能な友達: {{ $post->selected_friend_ids }}</p>
                @endif
            </div>
        </div>
        
        <div class="row m-2">
            <div class="col-md-4">
                <div class="mt-4">
                    @if($post->image)
                        <img src="/images/{{ $post->image }}" alt="{{ $post->name }}" class="img-fluid" width="200">
                    @else
                        <img src="/images/no_image.png" alt="No Image" width="200">
                    @endif
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="mt-4">
                    {{-- 投稿者情報 --}}
                    <div class="mb-4">
                        <h5 class="font-weight-bold">投稿者情報</h5>
                        <p>投稿者: {{ $user->name }}</p>
                    </div>
                    
                    {{-- 会った方の情報 --}}
                    <div class="mb-4">
                        <h5 class="font-weight-bold">会った方の情報</h5>
                        <p>名前: {{ $match_user->name }}</p>
                        <p>住所: {{ $match_user->address }}</p>
                        <p>職業: {{ $match_user->work }}</p>
                        @if($match_user->way_id == 1)
                            <p>出会い方: {{ $match_user->other_way }}</p>
                        @else
                            <p>出会い方: {{ $way->way }}</p>
                        @endif
                    </div>
                    
                    {{-- 投稿の詳細情報 --}}
                    <div class="mb-4">
                        <h5 class="font-weight-bold">投稿の詳細情報</h5>
                        <p>タイトル: {{ $post->title }}</p>
                        <p>会った日: {{ $post->date_day }}</p>
                        <p>会った場所: {{ $post->place }}</p>
                        <p>内容: {{ $post->body }}</p>
                    </div>
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
                        {{-- いいねしてくれたユーザー表示 --}}
                        @if($favorite->count() > 0)
                            <div class="d-inline-block mr-2">
                                @foreach($favorite as $favorite)
                                    <p>いいねをくれた友達：{{ $favorite->name }}</p>
                                @endforeach
                            </div>
                        @endif
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