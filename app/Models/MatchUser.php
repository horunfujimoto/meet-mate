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
    
    // protected $fillable = [
    //     'name', 
    //     'address',
    //     'work',
    //     'birthday',
    //     'sns',
    //     'way',
    //     'others',
    //     'image',
    // ];
}
