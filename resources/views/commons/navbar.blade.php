<header class="mb-4">
    <nav class="navbar navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <div class="d-flex align-items-center">
            <h1 class="m-0 font-weight-bold"><a class="btn btn-link text-white" href="/">meet-mate</a></h1>
        </div>
        {{-- その他リンク --}}
        <div class="d-flex align-items-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <ul class="list-inline mb-0 text-white d-flex">
                    @include('commons.link_items')
                </ul>
            </form>
        </div>
    </nav>
</header>
