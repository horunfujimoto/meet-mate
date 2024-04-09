<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 特定の投稿をいいねする
        Auth::user()->favorite($id);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 特定の投稿をいいね解除する
        Auth::user()->unfavorite($id);

        // 前のURLへリダイレクトさせる
        return back();
    }
}
