<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost normal-case text-xl" href="/">meet-mate</a></h1>
        </div>
        {{-- その他リンク --}}
        <div class="flex-none">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <ul>
                    @include('commons.link_items')
                </ul>
                </div>
            </form>
        </div>
    </nav>
</header>