<?php

namespace App\Http\Controllers;

use App\Models\Post; // Postモデルをインポート
use App\Models\MatchUser;  // MatchUserモデルをインポート
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class PostsController extends Controller
{
    
    public function index(Request $request)
    {
        if (\Auth::check()) {
            
            $user = Auth()->user(); // ログイン中のユーザーを取得
            
            // 友達のIDを取得
            $friend_ids = $user->myfriends()->pluck('users.id')->toArray();
    
            // 友達の投稿のみを取得するクエリを作成
            $query = Post::query()
                ->whereIn('user_id', $friend_ids)
                ->where(function ($q) {
                    $q->where('status', 'public')
                        ->orWhere(function ($q) {
                            $q->where('status', 'limited')
                                ->where('selected_friend_ids', 'like', '%' . Auth()->user()->name . '%');
                        });
                })
                ->orderBy('id', 'desc');
    
            // キーワードが指定されていれば、タイトルで部分一致検索を行う
            if ($request->has('keyword') && !empty($request->keyword)) {
                $keyword = $request->keyword;
                $query->where('title', 'like', "%$keyword%");
            }
    
            $posts = $query->paginate(10);
    
            foreach ($posts as $post) {
                $match_user = MatchUser::find($post->match_user_id);
                // $match_userに直接名前を代入する
                $post->match_user_name = $match_user->name;
            }
    
            return view('posts.index', [
                'posts' => $posts,
                'keyword' => $request->keyword ?? '', // ビューにキーワードを渡す
            ]);
        }
    
        // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }


    public function create()
    {
        $match_users = MatchUser::where('user_id', Auth()->id())->get();
        
        $post = new Post;
        $friends = Auth()->user()->myfriends;
    
        // 作成ビューを表示
        return view('posts.create', [
            'match_users' => $match_users,
            'post' => $post,
            'friends' => $friends,
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
        $post->status = $request->status; // 公開ステータス
        $post->selected_friend_ids = is_array($request->selected_friend_ids) ? implode(',', $request->selected_friend_ids) : $request->selected_friend_ids;
        
        // 画像の保存
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename); // public/images ディレクトリに保存
            $post->image = $filename;
        }
        
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
        
        // いいねくれたユーザーを取得
        $favorite = $post->favorite_users()->get();
        
        // アクセス制限を追加
        if ($post->status === '公開') {
            // 公開投稿の場合は、投稿者と投稿者の友達のみ表示
            if (Auth::id() === $user->id || $user->myfriends->contains(Auth::id())) {
                // 投稿に関連付けられた MatchUser の ID を取得
                $match_user_id = $post->match_user_id;
            
                // MatchUser の ID を使って名前を取得
                $match_user = MatchUser::findOrFail($match_user_id);
                
                // 投稿に紐づくコメント一覧を取得
                $comments = $post->comments()->get();
                
                // ビューにデータを渡す
                return view('posts.show', [
                    'post' => $post,
                    'user' => $user,
                    'match_user' => $match_user,
                    'comments' => $comments, // コメント一覧を渡す
                    'favorite' => $favorite,
                ]);
            }
        } elseif ($post->status === '非公開') {
            // 非公開投稿の場合は、投稿者のみ表示
            if (Auth::id() === $user->id) {
                // 投稿に関連付けられた MatchUser の ID を取得
                $match_user_id = $post->match_user_id;
            
                // MatchUser の ID を使って名前を取得
                $match_user = MatchUser::findOrFail($match_user_id);
                
                // 投稿に紐づくコメント一覧を取得
                $comments = $post->comments()->get();
                
                // ビューにデータを渡す
                return view('posts.show', [
                    'post' => $post,
                    'user' => $user,
                    'match_user' => $match_user,
                    'comments' => $comments, // コメント一覧を渡す
                    'favorite' => $favorite,
                ]);
            }
        } elseif ($post->status === '限定公開') {
            // 限定公開投稿の場合は、投稿者と特定の友達のみ表示
             if (Auth::id() === $user->id || in_array(Auth()->user()->name, explode(',', $post->selected_friend_ids))) {
                // 投稿に関連付けられた MatchUser の ID を取得
                $match_user_id = $post->match_user_id;
            
                // MatchUser の ID を使って名前を取得
                $match_user = MatchUser::findOrFail($match_user_id);
                
                // 投稿に紐づくコメント一覧を取得
                $comments = $post->comments()->get();
                
                // ビューにデータを渡す
                return view('posts.show', [
                    'post' => $post,
                    'user' => $user,
                    'match_user' => $match_user,
                    'comments' => $comments, // コメント一覧を渡す
                    'favorite' => $favorite,
                ]);
            }
        }
        
        // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
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
        $match_users = MatchUser::where('user_id', Auth()->id())->get();
        
        // MatchUser の ID を使って名前を取得
        $match_user = MatchUser::findOrFail($match_user_id);
        
        $friends = Auth()->user()->myfriends;
        
        if (\Auth::id() === $post->user_id) {
            // ビューにデータを渡す
            return view('posts.edit', [
                'post' => $post,
                'user' => $user,
                'match_user' => $match_user,
                'match_users' => $match_users, // $match_users を追加
                'friends' => $friends,
            ]);
        }
        
         // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }


    public function update(Request $request, $id)
    {
        // 更新対象の投稿を取得
        $post = Post::findOrFail($id);
        
        if (\Auth::id() === $post->user_id) {
            // フォームから送信されたデータで投稿を更新
            $post->title = $request->title;
            $post->date_day = $request->date_day;
            $post->place = $request->place;
            $post->body = $request->body;
            $post->match_user_id = $request->match_user_id;
            $post->status = $request->status; // 公開ステータス
            $post->selected_friend_ids = is_array($request->selected_friend_ids) ? implode(',', $request->selected_friend_ids) : $request->selected_friend_ids;
            
            // 画像の保存
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename); // public/images ディレクトリに保存
                $post->image = $filename;
            } else {
                // 再選択なしでの更新の場合は、元の画像を保持する
                $post->image = $post->image;
            }
            
            // 更新を保存
            $post->save();
            
            // 保存後、投稿の詳細ページにリダイレクト
            return redirect()->route('posts.show', $post->id);
        }
        
         // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }


    public function destroy($id)
    {
        // idを検索して取得
        $post = Post::findOrFail($id);
        if (\Auth::id() === $post->user_id) {
            // 削除
            $post->delete();
            // 一覧ページ
            return redirect()->route('myposts');
        }
        
         // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }
    
    
    //自分のすべての投稿
    public function myposts(Request $request)
    {
        $user = Auth()->user(); // ログイン中のユーザーを取得
    
        $posts = Post::query()->where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        
        foreach ($posts as $post) {
            $match_user = MatchUser::find($post->match_user_id);
            // $match_userがnullでないことを前提として、直接名前を代入する
            $post->match_user_name = $match_user->name;
        }
        
        return view('posts.myposts', [
            'posts' => $posts,
        ]);
    }
    
    
    // 自分の非公開の投稿
    public function private_myposts(Request $request)
    {
        $user = Auth()->user(); // ログイン中のユーザーを取得
    
        $posts = Post::query()->where('user_id', $user->id)->where('status', 'private')->orderBy('id', 'desc')->paginate(10);
        
        foreach ($posts as $post) {
            $match_user = MatchUser::find($post->match_user_id);
            // $match_userがnullでないことを前提として、直接名前を代入する
            $post->match_user_name = $match_user->name;
        }
        
        return view('posts.private_myposts', [
            'posts' => $posts,
        ]);
    }


}
