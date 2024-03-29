@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
        </aside>
        <div class="sm:col-span-2 mt-4">
            <div class="mt-4">
                <ul class="list-none">
                @foreach ($users as $myfriend) {{-- $myfriends -> $users --}}
                    <li class="flex items-center gap-x-2 mb-4">
                        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <div class="avatar">
                            <div class="w-12 rounded">
                                <img src="{{ Gravatar::get($myfriend->email) }}" alt="" />
                            </div>
                        </div>
                        <div>
                            <div>
                                {{ $myfriend->name }}
                            </div>
                            <div>
                                {{-- 友達申請・解除ボタン --}}
                                @include('friends.friend_button')
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>

            {{-- 友達がいない場合のメッセージ --}}
            @if($users->isEmpty())
                <p>友達はまだいません。ユーザー一覧より友達申請をしてください。</p>
            @endif
            
            {{-- ページネーションのリンク --}}
            {{ $users->links() }}
        　　</div>
    　　</div>
    </div>
@endsection
