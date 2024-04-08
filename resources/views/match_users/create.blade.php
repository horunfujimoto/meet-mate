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
                    <span class="label-text"><span style="color:red;">＊</span>名前:</span>

                </label>
                <input type="text" name="name" class="input input-bordered w-full" required>
                
                <label for="address" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>住んでる場所:</span>
                </label>
                <input type="text" name="address" class="input input-bordered w-full" required>
                
                <label for="work" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>職業:</span>
                </label>
                <input type="text" name="work" class="input input-bordered w-full" required>
                
                <label for="birthday" class="label">
                    <span class="label-text">誕生日(任意):</span>
                </label>
                <input type="date" name="birthday" class="input input-bordered w-full">
                
                <label for="sns" class="label">
                    <span class="label-text">SNS(任意):</span>
                </label>
                <input type="text" name="sns" class="input input-bordered w-full">
                
                <label for="way_id" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>出会い方:</span>
                </label>
                <select id="way_id" name="way_id" class="form-control">
                    @foreach($ways as $way)
                        <option value="{{ $way->id }}" {{ $way->id == 2 ? 'selected' : '' }}>{{ $way->way }}</option>
                    @endforeach
                </select>

                <!-- その他の出会い方の追加入力フィールド -->
                <div id="other_way_input" style="display: none;">
                    <label for="other_way" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>その他の出会い方を入力してください↓</span>
                    </label>
                    <input type="text" name="other_way" class="input input-bordered w-full">
                </div>
                                
                <label for="others" class="label">
                    <span class="label-text">その他情報(任意):</span>
                </label>
                <input type="text" name="others" class="input input-bordered w-full">
                
                <label for="image" class="label">
                    <span class="label-text"><span style="color:red;"></span>プロフィール画像(任意):</span>
                </label>

                <input type="file" name="image" class="input input-bordered w-full" id="myImage" accept="image/*">
                <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto">
                
            </div>

            <button type="submit" class="btn btn-outline text-" style="background-color: #FF6699; color: white; font-size: 1.2rem;">登録</button>
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
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        }); 
    </script>
    
@endsection