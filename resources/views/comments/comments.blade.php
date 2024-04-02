<div class="m-4">
    @if (isset($comments) && count($comments) > 0)
        <ul class="list-group">
            @foreach ($comments as $comment)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            {{-- ユーザー名とコメント内容 --}}
                            <p class="mb-0">
                                <strong>{{ $comment->user->name }}</strong>: {!! nl2br(e($comment->comment)) !!}
                            </p>
                        </div>
                        
                        {{-- コメント削除ボタン --}}
                        <div>
                            @if (Auth::id() == $comment->user_id)
                                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('削除しますか？')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>コメントはありません。</p>
    @endif
</div>

