@if (Auth::id() != $user->id)
    @if (Auth::user()->is_friends($user->id))
        <form method="POST" action="{{ route('user.unfriend', $user->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" 
                onclick="return confirm('id = {{ $user->id }} の友達をやめてもよろしいですか？')"
                style="background-color: white; color: #FF3385; font-size: 1.2rem; border: 2px solid #FF6699;">友達をやめる</button>
        </form>
    @else
        <form method="POST" action="{{ route('user.friend', $user->id) }}">
            @csrf
            <button type="submit" class="btn" style="background-color: #FF6699; color: white; font-size: 1.2rem;">友達になる</button>
        </form>
    @endif
@endif
