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

}
