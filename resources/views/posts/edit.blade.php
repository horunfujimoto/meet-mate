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
                    <span class="label-text"><span style="color:red;">＊</span>会った方:</span>
                </label>
                <select name="match_user_id" class="input input-bordered w-full">
                    @foreach($match_users as $match_user)
                        <option value="{{ $match_user->id }}">{{ $match_user->name }}</option>
                    @endforeach
                </select>
                
                <label for="title" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>タイトル:</span>
                </label>
                <input type="text" name="title" value="{{ $post->title }}" class="input input-bordered w-full" required>
                
                <label for="date_day" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>会った日:</span>
                </label>
                <input type="date" name="date_day" value="{{ $post->date_day }}" class="input input-bordered w-full" required>
                
                <label for="place" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>会った場所:</span>
                </label>
                <input type="text" name="place" value="{{ $post->place }}" class="input input-bordered w-full" required>
                
                <label for="body" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>内容:</span>
                </label>
                <input type="text" name="body" value="{{ $post->body }}" class="input input-bordered w-full" required>
            
                <label for="image" class="label">
                    <span class="label-text">デート写真(変更前):</span>
                </label>
                <div class="m-2">
                    @if($post->image)
                        <img src="/images/{{ $post->image }}" alt="{{ $post->name }}" width="100">
                    @else
                        <img src="/images/no_image.png" alt="No Image" width="100">
                    @endif
                </div>
                
                <input type="file" name="image" class="input input-bordered w-full" id="myImage" accept="image/*">
                <img id="preview" src="#" alt="プレビュー画像" width="200px" height="auto" hidden>
                
                <!-- ここに公開ステータスを選ぶ記述 -->
                <label for="status" class="label">
                    <span class="label-text"><span style="color:red;">＊</span>公開ステータス:</span>
                </label>
                <select id="status" name="status" class="form-control">
                    <option value="public">公開</option>
                    <option value="private">非公開</option>
                    <option value="limited">限定公開</option>
                </select>
                
                <!-- 限定公開選択フィールド -->
                <div id="limited_input" style="display: none;">
                    <label for="limited" class="label">
                        <span class="label-text"><span style="color:red;">＊</span>公開する友達を選択してください↓</span>
                    </label>
                    @foreach($friends as $friend)
                    <div>
                        <input type="checkbox" name="selected_friend_ids[]" value="{{ $friend->name }}" class="mr-2">
                        <span>{{ $friend->name }}</span>
                    </div>
                    @endforeach
                </div>
                
            </div>

            <button type="submit" class="btn btn-outline" style="background-color: #FF6699; color: white; font-size: 1.2rem;">更新</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // 公開ステータスが変更されたときの処理
            $('#status').change(function() {
                if ($(this).val() === 'limited') {
                    $('#limited_input').show();
                    $('input[name="selected_friend_ids[]"]').prop('required', true); // 限定公開が選択されたらチェックボックスを必須にする
                } else {
                    $('#limited_input').hide();
                    // 限定公開以外が選択された場合は全チェックボックスの required 属性を削除する
                    $('input[name="selected_friend_ids[]"]').removeAttr('required');
                }
            });
    
            // チェックボックスの状態変化時の処理
            $('input[name="selected_friend_ids[]"]').on('change', () => {
                // チェック済みチェックボックス数をカウント
                const isCheckedCount = $('input[name="selected_friend_ids[]"]:checked').length;
    
                // カウントが1以上の場合は全チェックボックスの required 属性を削除する
                isCheckedCount > 0
                    ? $('input[name="selected_friend_ids[]"]').removeAttr('required')
                    : $('input[name="selected_friend_ids[]"]').prop('required', true);
            });
    
            // 画像のプレビュー表示
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
        });
    </script>
    
@endsection
