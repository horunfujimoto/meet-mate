<?php

namespace App\Http\Controllers;

use App\Models\MatchUser; // MatchUserモデルをインポート
use Illuminate\Support\Facades\Auth; // Authをインポート
use Illuminate\Http\Request;

class MatchUsersController extends Controller
{
    
    public function index()
    {
        if (\Auth::check()) {
            // 出会った方一覧をidの降順で取得
            $match_users = MatchUser::orderBy('id', 'desc')->paginate(10);
    
            // ユーザ一覧ビューでそれを表示
            return view('match_users.index', [
                'match_users' => $match_users,
            ]);
        }
    }

    public function create()
    {
        $match_user = new MatchUser;

        // 作成ビューを表示
        return view('match_users.create', [
            'match_user' => $match_user,
        ]);
    }

    public function store(Request $request)
    {
        // 認証済みユーザーのIDを取得
        $user_id = Auth::id();
        
        $match_user = new MatchUser;

        $match_user->name = $request->name;
        $match_user->address = $request->address;
        $match_user->work = $request->work;
        $match_user->birthday = $request->birthday;
        $match_user->sns = $request->sns;
        $match_user->way = $request->way;
        $match_user->others = $request->others;
        $match_user->image = $request->image;
        $match_user->user_id = $user_id;
        
        $match_user->save();
        
        // 詳細ページ
        return redirect()->route('match_users.show', $match_user->id);
    }

    public function show($id)
    {
        // idの値で検索して取得
        $match_user = MatchUser::findOrFail($id);

        // 詳細ビューでそれを表示
        return view('match_users.show', [
            'match_user' => $match_user,
        ]);
    }

    public function edit($id)
    {
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        
        if (\Auth::id() === $match_user->user_id) {
        return view('match_users.edit', [
            'match_user' => $match_user,
        ]);
        }
         // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

    public function update(Request $request, $id)
    {
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        if (\Auth::id() === $match_user->user_id) {
            // 更新
            $match_user->name = $request->name;
            $match_user->address = $request->address;
            $match_user->work = $request->work;
            $match_user->birthday = $request->birthday;
            $match_user->sns = $request->sns;
            $match_user->way = $request->way;
            $match_user->others = $request->others;
            $match_user->image = $request->image;
            
            $match_user->save();
            // 詳細ビューでそれを表示
            return redirect()->route('match_users.show', $match_user->id);
        }
         // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

    public function destroy($id)
    {
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        
         if (\Auth::id() === $match_user->user_id) {
            // 削除
            $match_user->delete();
            // 一覧ページ
            return redirect()->route('match_users.index');
         }
         
         // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

}
