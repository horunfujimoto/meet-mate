<header class="mb-4">
    <nav class="navbar" style="background-color: #FF6699; font-size: 1.2rem;">
        {{-- トップページへのリンク --}}
        <div class="d-flex align-items-center">
            <h1 class="font-weight-bold"><a class="link" href="/posts">meet♥mate</a></h1>
        </div>
        {{-- その他リンク --}}
        <div class="d-flex align-items-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <ul class="mb-0">
                    @include('commons.link_items')
                </ul>
            </form>
        </div>
    </nav>
</header>
