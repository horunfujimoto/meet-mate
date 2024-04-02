@if (Auth::check())
    <li class="list-inline-item mx-2"><a class="link link-hover" href="{{ route('users.index') }}">User一覧</a></li>
    <li class="list-inline-item mx-2"><a class="link link-hover" href="{{ route('match_users.create') }}">出会った人登録</a></li>
    <li class="list-inline-item mx-2"><a class="link link-hover" href="{{ route('posts.create') }}">投稿</a></li>
    {{-- ログアウトへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link link-hover" href="{{ route('register') }}">サインイン</a></li>
    {{-- ログインページへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif