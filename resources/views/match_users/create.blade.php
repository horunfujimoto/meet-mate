@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>出会った方の登録</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('match_users.store') }}" class="w-1/2" enctype="multipart/form-data">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前:</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full" required>
                
                <label for="address" class="label">
                    <span class="label-text">住んでる場所:</span>
                </label>
                <input type="text" name="address" class="input input-bordered w-full" required>
                
                <label for="work" class="label">
                    <span class="label-text">職業:</span>
                </label>
                <input type="text" name="work" class="input input-bordered w-full" required>
                
                <label for="birthday" class="label">
                    <span class="label-text">誕生日:</span>
                </label>
                <input type="date" name="birthday" class="input input-bordered w-full" required>
                
                <label for="sns" class="label">
                    <span class="label-text">SNS:</span>
                </label>
                <input type="text" name="sns" class="input input-bordered w-full" required>
                
                <label for="way" class="label">
                    <span class="label-text">出会い方:</span>
                </label>
                <input type="text" name="way" class="input input-bordered w-full" required>
                
                <label for="others" class="label">
                    <span class="label-text">その他情報:</span>
                </label>
                <input type="text" name="others" class="input input-bordered w-full" required>
                
                <label for="image" class="label">
                    <span class="label-text">画像:</span>
                </label>
                <input type="file" name="image" class="input input-bordered w-full" required>
                
            </div>

            <button type="submit" class="btn btn-outline" style="background-color: #FF6699; color: white; font-size: 1.2rem;">投稿</button>
        </form>
    </div>
@endsection
