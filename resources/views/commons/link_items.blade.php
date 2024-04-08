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
                        <a class="link" href="{{ route('match_users.index') }}">出会った方一覧</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="link" href="{{ route('posts.index') }}">みんなの投稿一覧</a>
                    </li>
                    {{-- ログアウトへのリンク --}}
                    <li class="nav-item mx-2">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                        </form>
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
