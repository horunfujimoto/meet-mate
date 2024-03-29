<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルをインポート
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // ログインユーザーのIDを取得
        $loggedInUserId = auth()->id();
    
        // 自分以外のユーザーをidの降順で取得
        $users = User::where('id', '!=', $loggedInUserId)->orderBy('id', 'desc')->paginate(10);
    
        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function friends($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // ユーザが友達申請したユーザー一覧を取得
        $friends = $user->friends()->paginate(10);

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

        // ユーザに友達申請くれたユーザー一覧を取得
        $friendRequests = $user->friendRequests()->paginate(10);

        // 一覧ビューでそれらを表示
        return view('users.friendRequests', [
            'user' => $user,
            'users' => $friendRequests,
        ]);
    }

}
