<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Way extends Model
{
    use HasFactory;
    /**
     * （ MatchUserモデルとの関係を定義）
     */
    public function match_users()
    {
        return $this->belongsTo(MatchUser::class);
    }
}
