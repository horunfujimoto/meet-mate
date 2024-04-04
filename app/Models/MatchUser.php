<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchUser extends Model
{
    use HasFactory;
    
    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * 出会った方と紐づく投稿。（ Postモデルとの関係を定義）
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    /**
     * 出会った方と紐づく出会い方。（ waysモデルとの関係を定義）
     */
    public function ways()
    {
        return $this->hasMany(Way::class);
    }
}