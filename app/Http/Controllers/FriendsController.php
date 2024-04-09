<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        if (\Auth::check()) {
            
            $user = Auth()->user();
        
            // 相互の友達を取得
            $myfriends = $user->myfriends()->paginate(10);
        
            // 一覧ビューでそれらを表示
            return view('friends.index', [
                'user' => $user,
                'users' => $myfriends,
            ]);
        }
    }

    
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザを友達申請する
        \Auth::user()->friend($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのユーザを友達解除する
        \Auth::user()->unfriend($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
