@if (Auth::check())
    {{-- ログアウトへのリンク --}}
    <li class="list-inline-item"><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
    <li class="list-inline-item"><a class="link link-hover" href="{{ route('dashboard') }}">リンク！！いまだけおいておく</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li class="list-inline-item"><a class="link link-hover" href="{{ route('register') }}">サインイン</a></li>
    {{-- ログインページへのリンク --}}
    <li class="list-inline-item"><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif