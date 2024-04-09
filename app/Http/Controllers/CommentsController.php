<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\MatchUser;
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function store(Request $request, $post_id)
    {
        // 新しいコメントを作成して保存する
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->save();
    
        // リダイレクトして投稿が成功した旨を表示
        return redirect()->route('posts.show', $post_id)->with('success', 'コメントが投稿されました');
    }


    public function destroy($post_id, $comment_id)
    {
        $user = Auth()->user();
        
        // コメントを検索して取得
        $comment = Comment::findOrFail($comment_id);
        
        // 関連する投稿を取得
        $post = $comment->post_id;
    
        if ($user->id === $comment->user_id) {
            $comment->delete();
            return redirect()->route('posts.show', $post)->with('success', 'コメントが削除されました');
        }
    
        // 前のURLへリダイレクトさせる
        return back();
    }


}
