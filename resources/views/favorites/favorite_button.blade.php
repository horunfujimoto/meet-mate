@if(Auth::check())
    @if(Auth::user()->is_favorite($post->id))
        {{-- いいね済みの場合 --}}
        <form action="{{ route('post.unfavorite', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">いいねをやめる</button>
        </form>
    @else
        {{-- いいねしていない場合 --}}
        <form action="{{ route('post.favorite', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-primary">いいね！</button>
        </form>
    @endif
@endif