<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}" id="tab1-tab" data-toggle="tab" href="{{ route('users.index') }}" role="tab" aria-controls="tab1" aria-selected="{{ Request::routeIs('users.index') ? 'true' : 'false' }}">ユーザ一覧</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('myfriends.index') ? 'active' : '' }}" id="tab2-tab" data-toggle="tab" href="{{ route('myfriends.index') }}" role="tab" aria-controls="tab2" aria-selected="{{ Request::routeIs('myfriends.index') ? 'true' : 'false' }}">友達一覧</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('users.friends') ? 'active' : '' }}" id="tab3-tab" data-toggle="tab" href="{{ route('users.friends', auth()->id()) }}" role="tab" aria-controls="tab3" aria-selected="{{ Request::routeIs('users.friends') ? 'true' : 'false' }}">友達申請をしているユーザー</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('users.friendRequests') ? 'active' : '' }}" id="tab4-tab" data-toggle="tab" href="{{ route('users.friendRequests', auth()->id()) }}" role="tab" aria-controls="tab4" aria-selected="{{ Request::routeIs('users.friendRequests') ? 'true' : 'false' }}">友達申請をくれたユーザー</a>
    </li>
</ul>