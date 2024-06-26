<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-icon" ><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('users.index') }}">ユーザー関連</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('match_users.index') }}">出会った方</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('posts.index') }}">投稿関連</a>
                    </li>
                    {{-- ログアウトへのリンク --}}
                    <li class="list-inline-item mx-2">
                        <a class="link" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a>
                    </li> 
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('register') }}">サインイン</a>
                    </li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('login') }}">ログイン</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
