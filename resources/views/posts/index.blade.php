@extends('layouts.app')

@section('content')
    <div class="prose ml-4 mt-8">
        <h2>みんなの投稿一覧</h2>
    </div>

    <div class="flex justify-center">
        <table class="w-1/2 border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">投稿者</th>
                    <th class="border border-gray-300 px-4 py-2">タイトル</th>
                    <th class="border border-gray-300 px-4 py-2">会った日</th>
                    <th class="border border-gray-300 px-4 py-2">会った方</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr onclick="window.location='{{ route('posts.show', $post->id) }}';" style="cursor:pointer;">
                        <td class="border border-gray-300 px-4 py-2">{{ $post->user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $post->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $post->date_day }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $post->match_user_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
