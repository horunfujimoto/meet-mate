@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">みんなの投稿一覧</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem;">投稿作成</a>
        </div>
        <div class="row mt-4">
            <table class="table table-bordered ">
                <div class="py-2">
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
                </div>
            </table>
        </div>
    </div>
@endsection