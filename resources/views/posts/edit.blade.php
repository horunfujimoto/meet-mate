@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $post->title }}の投稿編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-control my-4">
                
                <label for="match_user_id" class="label">
                    <span class="label-text">会った方:</span>
                </label>
                <select name="match_user_id" class="input input-bordered w-full">
                    @foreach($match_users as $match_user)
                        <option value="{{ $match_user->id }}">{{ $match_user->name }}</option>
                    @endforeach
                </select>
                
                <label for="title" class="label">
                    <span class="label-text">タイトル:</span>
                </label>
                <input type="text" name="title" value="{{ $post->title }}" class="input input-bordered w-full" required>
                
                <label for="date_day" class="label">
                    <span class="label-text">会った日:</span>
                </label>
                <input type="date" name="date_day" value="{{ $post->date_day }}" class="input input-bordered w-full" required>
                
                <label for="place" class="label">
                    <span class="label-text">会った場所:</span>
                </label>
                <input type="text" name="place" value="{{ $post->place }}" class="input input-bordered w-full" required>
                
                <label for="body" class="label">
                    <span class="label-text">内容:</span>
                </label>
                <input type="text" name="body" value="{{ $post->body }}" class="input input-bordered w-full" required>
                
                <label for="image" class="label">
                    <span class="label-text">画像:</span>
                </label>
                <img src="/images/{{ $post->image }}" alt="{{ $post->name }}" width="100">
                <input type="file" name="image" class="input input-bordered w-full mt-3">
                
            </div>

            <button type="submit" class="btn btn-primary btn-outline">更新</button>
        </form>
    </div>
@endsection
