<div class="mt-4">
    <h3>コメント</h3>
    <div>
        <form method="POST" action="{{ route('comments.store', ['id' => $post->id]) }}">
            @csrf
        
            <div class="form-control mt-4" style="display: flex; justify-content: space-between;">
                <textarea rows="2" name="comment" class="input input-bordered w-full"></textarea>
                <button type="submit" class="btn normal-case" style="background-color: #FF6699; color: white; font-size: 1.2rem;"><i class="fa-regular fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
</div>
