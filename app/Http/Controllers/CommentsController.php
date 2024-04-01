<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\MatchUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function store(Request $request, $postId)
    {
        // 新しいコメントを作成して保存する
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->save();

        // コメント送信後、投稿の詳細ページにリダイレクトする前に、コメント一覧を再取得
        $post = Post::findOrFail($postId);
        $user = $post->user;
        $match_user_id = $post->match_user_id;
        $match_user = MatchUser::findOrFail($match_user_id);
        $comments = $post->comments()->get(); // 投稿に紐づくコメント一覧を取得

        // ビューにデータを渡す
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
            'match_user' => $match_user,
            'comments' => $comments, // コメント一覧を再度渡す
            'postId' => $postId, // $postId を追加
        ]);
    }

    
    public function destroy($id)
    {
        // コメントを検索して取得
        $comment = \App\Models\Comment::findOrFail($id);
        
        // 関連する投稿を取得
        $post = $comment->post;
    
        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
            return redirect()->route('posts.show', $post->id);
        }
    
        // 前のURLへリダイレクトさせる
        return back();
    }


}
