<?php

namespace App\Http\Controllers;

use App\Models\MatchUser; // MatchUserモデルをインポート
use Illuminate\Http\Request;

class MatchUsersController extends Controller
{
    
    public function index()
    {
        // // 出会った方一覧をidの降順で取得
        // $match_users = MatchUser::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('match_users.index');
    }

    public function create()
    {
        return view('match_users.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    
}
