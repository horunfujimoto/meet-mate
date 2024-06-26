<?php

namespace App\Http\Controllers;

use App\Models\MatchUser; // MatchUserモデルをインポート
use Illuminate\Support\Facades\Auth; // Authをインポート
use App\Models\Way;
use Illuminate\Http\Request;

class MatchUsersController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth()->user();
        
        // セレクトボックスで選択した値
        $select = $request->feeling;

        // セレクトボックスの値に応じてソート
        switch ($select) {
            case '1':
                //「指定なし」はID順
                $match_users = MatchUser::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
                break;
            case '2':
                // 「好感度が低い順」でソート
                $match_users = MatchUser::where('user_id', $user->id)->orderBy('feeling', 'asc')->paginate(10);
                break;
            case '3':
                // 「好感度が高い順」でソート
                $match_users = MatchUser::where('user_id', $user->id)->orderBy('feeling', 'desc')->paginate(10);
                break;
            default :
                // デフォルトはID順
                $match_users = MatchUser::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
                break;
        }
    
        // // 自分の投稿のみを取得し、idの降順で10件ずつページネーションして取得
        // $match_users = MatchUser::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        $ways = Way::all();
    
        // ユーザ一覧ビューでそれを表示
        return view('match_users.index', [
            'select' => $select,
            'match_users' => $match_users,
            'ways' => $ways, // $waysをビューに渡す
        ]);
    }

    public function create()
    {
        $match_user = new MatchUser;

        // Wayモデルからseederの内容取得
        $ways = Way::all();
    
        // 作成ビューを表示
        return view('match_users.create', [
            'match_user' => $match_user,
            'ways' => $ways, // $waysをビューに渡す
        ]);
    }

    public function store(Request $request)
    {
        // バリデーションの実行
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'age' => 'required|integer',
            'feeling' => 'required|integer',
            'address' => 'required|string|max:10',
            'work' => 'required|string|max:10',
            'birthday' => 'nullable|date',
            'sns' => 'nullable|string',
            'others' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'way_id' => 'required|string',
            'other_way' => 'nullable|string|max:10',
        ]);
    
        // 認証済みユーザーのIDを取得
        $user_id = Auth::id();
    
        // 新しいMatchUserインスタンスを作成
        $match_user = new MatchUser;
    
        // フォームからのデータを保存する
        $match_user->name = $request->name;
        $match_user->age = $request->age;
        $match_user->feeling = $request->feeling;
        $match_user->address = $request->address;
        $match_user->work = $request->work;
        $match_user->birthday = $request->birthday;
        $match_user->sns = $request->sns;
        $match_user->others = $request->others;
        $match_user->way_id = $request->way_id;
    
        // 出会い方が「その他」の場合は新しい出会い方を保存
        if ($request->way_id == 1) {
            $match_user->other_way = $request->other_way;
        }
    
        // 画像の保存
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $match_user->image = $filename;
        }
    
        $match_user->user_id = $user_id;
    
        // データの保存
        $match_user->save();
    
        // 詳細ページにリダイレクト
        return redirect()->route('match_users.show', $match_user->id);
    }



    public function show($id)
    {
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        
        if (Auth::id() === $match_user->user_id) {
            
            // 出会い方（Way）の情報を取得
            $way = Way::findOrFail($match_user->way_id);
        
            // 詳細ビューでそれを表示
            return view('match_users.show', [
                'match_user' => $match_user,
                'way' => $way, // 出会い方（Way）の情報をビューに渡す
            ]);
        }
        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

    public function edit($id)
    {
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        
        // Wayモデルからseederの内容取得
        $ways = Way::all();
        
        // $match_userに紐づく出会い方の名前を取得する
        $selected_way = $match_user->way_id == 1 ? $match_user->other_way : $match_user->way_id;
        
        if (Auth::id() === $match_user->user_id) {
            return view('match_users.edit', [
                'match_user' => $match_user,
                'ways' => $ways,
                'selected_way' => $selected_way, // 編集するユーザーの選択された出会い方のIDを渡す
            ]);
        }
        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }

    public function update(Request $request, $id)
    {
        
        // バリデーションの実行
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'age' => 'required|integer',
            'feeling' => 'required|integer',
            'address' => 'required|string|max:10',
            'work' => 'required|string|max:10',
            'birthday' => 'nullable|date',
            'sns' => 'nullable|string',
            'others' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'way_id' => 'required|string',
            'other_way' => 'nullable|string|max:10',
        ]);
        
        // idを検索して取得
        $match_user = MatchUser::findOrFail($id);
        
        if (Auth::id() === $match_user->user_id) {
            // 更新
            $match_user->name = $request->name;
            $match_user->age = $request->age;
            $match_user->feeling = $request->feeling;
            $match_user->address = $request->address;
            $match_user->work = $request->work;
            $match_user->birthday = $request->birthday;
            $match_user->sns = $request->sns;
            $match_user->others = $request->others;
            $match_user->way_id = $request->way_id;
            
            // 出会い方が「その他」の場合は新しい出会い方を保存
            if ($request->way_id == 1) {
                $match_user->other_way = $request->other_way;
            }
                
            // 画像の保存
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $filename); // public/images ディレクトリに保存
                $match_user->image = $filename;
            } else {
                // 再選択なしでの更新の場合は、元の画像を保持する
                $match_user->image = $match_user->image;
            }
            
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
        
         if (Auth::id() === $match_user->user_id) {
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
