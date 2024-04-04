@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>投稿ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('posts.store') }}" class="w-1/2" enctype="multipart/form-data">
            @csrf

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
                <input type="text" name="title" class="input input-bordered w-full" required>
                
                <label for="date_day" class="label">
                    <span class="label-text">会った日:</span>
                </label>
                <input type="date" name="date_day" class="input input-bordered w-full" required>
                
                <label for="place" class="label">
                    <span class="label-text">会った場所:</span>
                </label>
                <input type="text" name="place" class="input input-bordered w-full" required>
                
                <label for="body" class="label">
                    <span class="label-text">内容:</span>
                </label>
                <input type="text" name="body" class="input input-bordered w-full" required>
                
                <label for="image" class="label">
                    <span class="label-text">デート写真:</span>
                </label>
                <input type="file" name="image" class="input input-bordered w-full" required>
                
            </div>

            <button type="submit" class="btn btn-outline" style="background-color: #FF6699; color: white; font-size: 1.2rem;">投稿</button>
        </form>
    </div>
@endsection
