@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>{{ $match_user->name }} さんの編集ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('match_users.update', $match_user->id) }}" class="w-1/2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前:</span>
                </label>
                <input type="text" name="name" value="{{ $match_user->name }}" class="input input-bordered w-full" required>
                
                <label for="address" class="label">
                    <span class="label-text">住んでる場所:</span>
                </label>
                <input type="text" name="address" value="{{ $match_user->address }}" class="input input-bordered w-full" required>
                
                <label for="work" class="label">
                    <span class="label-text">職業:</span>
                </label>
                <input type="text" name="work" value="{{ $match_user->work }}" class="input input-bordered w-full" required>
                
                <label for="birthday" class="label">
                    <span class="label-text">誕生日:</span>
                </label>
                <input type="date" name="birthday" value="{{ $match_user->birthday }}" class="input input-bordered w-full">
                
                <label for="sns" class="label">
                    <span class="label-text">SNS:</span>
                </label>
                <input type="text" name="sns" value="{{ $match_user->sns }}" class="input input-bordered w-full">
                
                <label for="way" class="label">
                    <span class="label-text">出会い方:</span>
                </label>

                <select id="way" name="way_id" class="form-control">
                    @foreach($ways as $way)
                        <option value="{{ $way->id }}" {{ $way->id == $selectedWay ? 'selected' : '' }}>
                            {{ $way->way }}
                        </option>
                    @endforeach
                </select>

                
                <label for="others" class="label">
                    <span class="label-text">その他情報:</span>
                </label>
                <input type="text" name="others" value="{{ $match_user->others }}" class="input input-bordered w-full">
                
                <label for="image" class="label">
                    <span class="label-text">プロフィール画像(変更前):</span>
                </label>
                <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" width="100">
                <input type="file" name="image" class="input input-bordered w-full mt-3" id="myImage" accept="image/*">
                <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto">
            </div>

            <button type="submit" class="btn btn-outline" style="background-color: #FF6699; color: white; font-size: 1.2rem;">更新</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myImage').on('change', function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
           });
        }); 
    </script>
    
@endsection