@if(Auth::check())
    @if(Auth::user()->is_favorite($post->id))
        {{-- いいね済みの場合 --}}
        <form action="{{ route('post.unfavorite', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-heart">いいね済</i></button>
        </form>
    @else
        {{-- いいねしていない場合 --}}
        <form action="{{ route('post.favorite', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-heart">いいね</i></button>
        </form>
    @endif
@endif