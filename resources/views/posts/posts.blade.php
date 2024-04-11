<!-- PC用のスタイル -->
<div class="container d-none d-md-block">
    <table class="table table-bordered">
        <thead style="background-color: #FFCCCC;">
            <tr>
                <th class="border border-gray-300 px-4 py-2">投稿者</th>
                <th class="border border-gray-300 px-4 py-2">タイトル</th>
                <th class="border border-gray-300 px-4 py-2">会った日</th>
                <th class="border border-gray-300 px-4 py-2">会った方</th>
                <th class="border border-gray-300 px-4 py-2">公開設定</th>
            </tr>
        </thead>
        <tbody>
             @foreach($posts as $post)
                <tr onclick="window.location='{{ route('posts.show', $post->id) }}';" style="cursor:pointer;">
                    <td class="border border-gray-300 px-4 py-2">{{ $post->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->date_day }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->match_users->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- スマートフォン用のスタイル -->
<div class="container d-md-none">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header" style="background-color: #FFCCCC;">
                    投稿者: {{ $post->user->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">会った日: {{ $post->date_day }}</p>
                    <p class="card-text">会った方: {{ $post->match_users->name }}</p>
                    <p class="card-text">公開設定: {{ $post->status }}</p>
                </div>
                <div class="card-footer text-muted" style="cursor:pointer;" onclick="window.location='{{ route('posts.show', $post->id) }}';">
                    タップして詳細を表示
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
