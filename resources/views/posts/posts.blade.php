<table class="table table-bordered ">
    <div class="py-2">
        <thead style="background-color: #FFCCCC;">
            <tr>
                <th class="border border-gray-300 px-4 py-2">投稿者</th>
                <th class="border border-gray-300 px-4 py-2">タイトル</th>
                <th class="border border-gray-300 px-4 py-2">会った日</th>
                <th class="border border-gray-300 px-4 py-2">会った方</th>
                <th class="border border-gray-300 px-4 py-2">公開ステータス</th>
            </tr>
        </thead>
        <tbody>
             @foreach($posts as $post)
                <tr onclick="window.location='{{ route('posts.show', $post->id) }}';" style="cursor:pointer;">
                    <td class="border border-gray-300 px-4 py-2">{{ $post->user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->date_day }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->match_user_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $post->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </div>
</table>
