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
                    <span class="label-text"><span style="color:red;">＊</span>名前:</span>
                </label>
                <input type="text" name="name" value="{{ $match_user->name }}" class="input input-bordered w-full" required>
                
                <label for="address" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>住んでる場所:</span>
                </label>
                <input type="text" name="address" value="{{ $match_user->address }}" class="input input-bordered w-full" required>
                
                <label for="work" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>職業:</span>
                </label>
                <input type="text" name="work" value="{{ $match_user->work }}" class="input input-bordered w-full" required>
                
                <label for="birthday" class="label">
                    <span class="label-text">誕生日(任意):</span>
                </label>
                <input type="date" name="birthday" value="{{ $match_user->birthday }}" class="input input-bordered w-full">
                
                <label for="sns" class="label">
                    <span class="label-text">SNS(任意):</span>
                </label>
                <input type="text" name="sns" value="{{ $match_user->sns }}" class="input input-bordered w-full">
                
                <label for="way_id" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>出会い方:</span>
                </label>
                <select id="way_id" name="way_id" class="form-control">
                    @foreach($ways as $way)
                        <option value="{{ $way->id }}" {{ $way->id == $match_user->way_id ? 'selected' : '' }}>{{ $way->way }}</option>
                    @endforeach
                </select>

                <!-- その他の出会い方の追加入力フィールド -->
                <div id="other_way_input" style="{{ $match_user->way_id > 11 ? 'display: block;' : 'display: none;' }}">
                    <label for="other_way" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>その他の出会い方を入力してください↓</span>
                    </label>
                    <input type="text" name="other_way" class="input input-bordered w-full" value="{{ $match_user->way_id > 11 ? $selectedWay : '' }}">
                </div>
                
                <label for="others" class="label">
                    <span class="label-text">その他情報(任意):</span>
                </label>
                <input type="text" name="others" value="{{ $match_user->others }}" class="input input-bordered w-full">
                
                <label for="image" class="label">
                    <span class="label-text">プロフィール画像(変更前):</span>
                </label>
                <div class="m-2">
                    @if($match_user->image)
                        <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" width="100">
                    @else
                        <img src="/images/no_image.png" alt="No Image" width="100">
                    @endif
                </div>
                
                <input type="file" name="image" class="input input-bordered w-full mt-3" id="myImage" accept="image/*">
                <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto" hidden>
            </div>

            <button type="submit" class="btn btn-outline" style="background-color: #FF6699; color: white; font-size: 1.2rem;">更新</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#way_id').change(function() {
                if ($(this).val() === '1') {
                    $('#other_way_input').show();
                } else {
                    $('#other_way_input').hide();
                }
            });
            
            $('#myImage').on('change', function (e) {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview').attr('src', e.target.result).removeAttr('hidden');
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    $('#preview').attr('src', '#').attr('hidden', 'hidden');
                }
            });
            
            // ページ読み込み時に表示を判定する
            if ($('#way_id').val() === '1') {
                $('#other_way_input').show();
            } else {
                $('#other_way_input').hide();
            }
        }); 
    </script>
    
@endsection
