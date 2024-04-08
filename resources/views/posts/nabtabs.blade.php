<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('posts.index') ? 'active' : '' }}" id="tab1-tab" data-toggle="tab" href="{{ route('posts.index') }}" role="tab" aria-controls="tab1" aria-selected="{{ Request::routeIs('posts.index') ? 'true' : 'false' }}">
            <span class="d-none d-sm-inline">友達の投稿</span>
            <span class="d-inline d-sm-none"><i class="fa-solid fa-handshake-simple"></i></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('myposts') ? 'active' : '' }}" id="tab1-tab" data-toggle="tab" href="{{ route('myposts') }}" role="tab" aria-controls="tab1" aria-selected="{{ Request::routeIs('myposts') ? 'true' : 'false' }}">
            <span class="d-none d-sm-inline">自分の投稿</span>
            <span class="d-inline d-sm-none"><i class="fa-solid fa-address-book"></i></span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('private_myposts') ? 'active' : '' }}" id="tab1-tab" data-toggle="tab" href="{{ route('private_myposts') }}" role="tab" aria-controls="tab1" aria-selected="{{ Request::routeIs('private_myposts') ? 'true' : 'false' }}">
            <span class="d-none d-sm-inline">自分の非公開投稿</span>
            <span class="d-inline d-sm-none"><i class="fa-solid fa-key"></i></span>
        </a>
    </li>
</ul>
