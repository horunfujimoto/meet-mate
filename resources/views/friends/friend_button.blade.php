@if (Auth::id() != $user->id)
    @if (Auth::user()->is_friends($user->id))
        <form method="POST" action="{{ route('user.unfriend', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-block normal-case" 
                onclick="return confirm('id = {{ $user->id }} の友達を解除してもよろしいですか？')">友達解除</button>
        </form>
    @else
        <form method="POST" action="{{ route('user.friend', $user->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">友達申請</button>
        </form>
    @endif
@endif
