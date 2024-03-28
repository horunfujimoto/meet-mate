<?php

namespace App\Http\Controllers;

use App\Models\Post; // Postモデルをインポート
use App\Models\MatchUser;  // MatchUserモデルをインポート
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        // みんなの投稿一覧をidの降順で取得
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        
        // ユーザ名を取得して$postに追加する
        foreach ($posts as $post) {
            $match_user = MatchUser::find($post->match_user_id);
            // $match_userがnullでないことを前提として、直接名前を代入する
            $match_user = MatchUser::findOrFail($match_user_id);
        }
    
        // ユーザ一覧ビューでそれを表示
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $match_users = MatchUser::where('user_id', auth()->id())->get();
        
        $post = new Post;
    
        // 作成ビューを表示
        return view('posts.create', [
            'match_users' => $match_users,
            'post' => $post,
        ]);
    }


    public function store(Request $request)
    {
        // 認証済みユーザーのIDを取得
        $user_id = Auth::id();
        
        $post = new Post;

        $post->title = $request->title;
        $post->date_day = $request->date_day;
        $post->place = $request->place;
        $post->body = $request->body;
        $post->image = $request->image;
        $post->user_id = $user_id;
        $post->match_user_id = $request->match_user_id;
        
        $post->save();
        
        // 詳細ページ
        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        // 投稿を取得
        $post = Post::findOrFail($id);
        
        // 投稿者の情報を取得
        $user = $post->user;
        
        // 投稿に関連付けられた MatchUser の ID を取得
        $match_user_id = $post->match_user_id;
    
        // MatchUser の ID を使って名前を取得
        $match_user = MatchUser::findOrFail($match_user_id);
        
        // ビューにデータを渡す
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
            'match_user' => $match_user,
        ]);
    }

    public function edit($id)
    {
        // 投稿を取得
        $post = Post::findOrFail($id);
        
        // 投稿者の情報を取得
        $user = $post->user;
        
        // 投稿に関連付けられた MatchUser の ID を取得
        $match_user_id = $post->match_user_id;
    
        // MatchUser モデルから会った相手のリストを取得
        $match_users = MatchUser::where('user_id', auth()->id())->get();
        
        // MatchUser の ID を使って名前を取得
        $match_user = MatchUser::findOrFail($match_user_id);
        
        // ビューにデータを渡す
        return view('posts.edit', [
            'post' => $post,
            'user' => $user,
            'match_user' => $match_user,
            'match_users' => $match_users, // $match_users を追加
        ]);
    }

    public function update(Request $request, $id)
    {
        // 更新対象の投稿を取得
        $post = Post::findOrFail($id);
    
        // フォームから送信されたデータで投稿を更新
        $post->title = $request->title;
        $post->date_day = $request->date_day;
        $post->place = $request->place;
        $post->body = $request->body;
        $post->image = $request->image;
        $post->match_user_id = $request->match_user_id;
        
        // 更新を保存
        $post->save();
        
        // 保存後、投稿の詳細ページにリダイレクト
        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id)
    {
        // idを検索して取得
        $post = Post::findOrFail($id);
        // 削除
        $post->delete();
        // 一覧ページ
        return redirect()->route('posts.index');
    }
}
