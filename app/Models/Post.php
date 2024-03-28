<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    /**
     * 出会った方を登録したユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿の出会った方。（ MatchUserモデルとの関係を定義）
     */
    public function match_users()
    {
        return $this->belongsTo(MatchUser::class);
    }
}
