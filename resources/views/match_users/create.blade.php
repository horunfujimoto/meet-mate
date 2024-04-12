@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2>出会った方の登録</h2>
    </div>

    <!--PC-->
    <div class="d-none d-md-block">
        <div class="flex justify-center">
            <form method="POST" action="{{ route('match_users.store') }}" class="w-1/2" enctype="multipart/form-data">
                @csrf
    
                <div class="form-control my-4">
                    <label for="name" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>名前(20文字):</span>
                    </label>
                    <input type="text" name="name" class="input input-bordered w-full" required>
                    
                    <label for="age" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>年齢:</span>
                    </label>
                    <input type="number" name="age" class="input input-bordered w-full" required min="0">
                    
                    <label for="feeling" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>好感度:</span>
                    </label>
                    <input type="number" name="feeling" class="input input-bordered w-full" required max="100">
                    
                    <label for="address" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>住んでる場所(10文字):</span>
                    </label>
                    <input type="text" name="address" class="input input-bordered w-full" required>
                    
                    <label for="work" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>職業(10文字):</span>
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
                            <span class="label-text"><span style="color:red;">＊</span>▼ほかの出会い方を入力してください(10文字)▼</span>
                        </label>
                        <input type="text" name="other_way" class="input input-bordered w-full input-small">
                    </div>
                                    
                    <label for="others" class="label">
                        <span class="label-text">その他情報(任意、50文字):</span>
                    </label>
                    <input type="text" name="others" class="input input-bordered w-full">
                    
                    <label for="image" class="label">
                        <span class="label-text"><span style="color:red;"></span>プロフィール画像(任意):</span>
                    </label>
    
                    <input type="file" name="image" class="input input-bordered w-full" id="my_image" accept="image/*">
                    <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto" hidden>
                    
                </div>
    
                <button type="submit" class="btn btn-outline text-" style="background-color: #FF6699; color: white; font-size: 1.2rem;">登録</button>
            </form>
        </div>
    </div>
    
    <!--スマホ-->
    <div class="d-md-none">
        <form method="POST" action="{{ route('match_users.store') }}" class="w-full" enctype="multipart/form-data">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>名前(20文字):</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full" required>
                
                <label for="age" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>年齢:</span>
                </label>
                <input type="number" name="age" class="input input-bordered w-full" required min="0">
                
                <label for="feeling" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>好感度:</span>
                </label>
                <input type="number" name="feeling" class="input input-bordered w-full" required max="100">
                
                <label for="address" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>住んでる場所(10文字):</span>
                </label>
                <input type="text" name="address" class="input input-bordered w-full" required>
                
                <label for="work" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>職業(10文字):</span>
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
                        <span class="label-text"><span style="color:red;">＊</span>▼ほかの出会い方を入力してください(10文字)▼</span>
                    </label>
                    <input type="text" name="other_way" class="input input-bordered w-full input-small">
                </div>
                                
                <label for="others" class="label">
                    <span class="label-text">その他情報(任意、50文字):</span>
                </label>
                <input type="text" name="others" class="input input-bordered w-full">
                
                <label for="image" class="label">
                    <span class="label-text"><span style="color:red;"></span>プロフィール画像(任意):</span>
                </label>

                <input type="file" name="image" class="input input-bordered w-full" id="my_image" accept="image/*">
                <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto" hidden>
                
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
            
            $('#way_id').change(function() {
                if ($(this).val() === '1') {
                    $('#other_way_input').show();
                    $('input[name="other_way"]').prop('required', true); // 出会い方が1の場合、入力フィールドを必須にする
                } else {
                    $('#other_way_input').hide();
                    $('input[name="other_way"]').prop('required', false); // 出会い方が1以外の場合、入力フィールドの必須属性を解除する
                }
            });
            
            $('#my_image').on('change', function (e) {
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
        }); 
    </script>
    
@endsection