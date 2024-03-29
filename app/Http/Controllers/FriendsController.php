<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{
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
