<div class="mt-4">
    <h3>コメント</h3>
    <div>
        <form method="POST" action="{{ route('comments.store', ['id' => $post->id]) }}">
            @csrf
        
            <div class="form-control mt-4">
                <textarea rows="2" name="comment" class="input input-bordered w-full"></textarea>
            </div>
        
            <button type="submit" class="btn btn-primary btn-block normal-case">コメント送信</button>
        </form>
    </div>
</div>
