<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (\Auth::check()) {
        
            // ログインユーザーのIDを取得
            $login_user_id = auth()->id();
            
            // ユーザークエリを取得
            $query = User::where('id', '!=', $login_user_id)->orderBy('id', 'desc');
            
            // キーワードが指定されていれば、名前で部分一致検索を行う
            if ($request->has('keyword') && !empty($request->keyword)) {
                $keyword = $request->keyword;
                $query->where('name', 'like', "%$keyword%");
            }
            
            // ページネーションを適用
            $users = $query->paginate(10);
            
            // ユーザ一覧ビューでそれを表示
            return view('users.index', [
                'users' => $users,
                'keyword' => $request->keyword ?? '', // ビューにキーワードを渡す
            ]);
            
        }
    
        // 前のURLへリダイレクトさせる
        return back()->with('Delete Failed');
    }

    
    public function friends($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
    
        // 自分が友達申請したユーザーかつ友達でないユーザー一覧を取得
        $friends = $user->friends()->whereNotIn('users.id', $user->myfriends()->pluck('users.id'))->paginate(10);
    
        // 一覧ビューでそれらを表示
        return view('users.friends', [
            'user' => $user,
            'users' => $friends,
        ]);
    }
    
    public function friendRequests($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
    
        // 自分が友達申請を受けたユーザーかつ友達でないユーザー一覧を取得
        $friend_requests = $user->friendRequests()->whereNotIn('users.id', $user->myfriends()->pluck('users.id'))->paginate(10);
    
        // 一覧ビューでそれらを表示
        return view('users.friendRequests', [
            'user' => $user,
            'users' => $friend_requests,
        ]);
    }



}
