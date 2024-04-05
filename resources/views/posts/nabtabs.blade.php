<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('posts.index') ? 'active' : '' }}" id="tab1-tab" data-toggle="tab" href="{{ route('posts.index') }}" role="tab" aria-controls="tab1" aria-selected="{{ Request::routeIs('posts.index') ? 'true' : 'false' }}">友達の投稿一覧</a>
    </li>

</ul>