@if (Auth::check())
    <li class="list-inline-item mx-2"><a class="link" href="{{ route('users.index') }}">ユーザー関連</a></li>
    <li class="list-inline-item mx-2"><a class="link" href="{{ route('match_users.index') }}">出会った方一覧</a></li>
    <li class="list-inline-item mx-2"><a class="link" href="{{ route('posts.index') }}">みんなの投稿一覧</a></li>
    {{-- ログアウトへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link" href="{{ route('register') }}">サインイン</a></li>
    {{-- ログインページへのリンク --}}
    <li class="list-inline-item mx-2"><a class="link" href="{{ route('login') }}">ログイン</a></li>
@endif