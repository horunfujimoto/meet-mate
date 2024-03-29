<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが登録した出会った方。（ MatchUserモデルとの関係を定義）
     */
    public function match_users()
    {
        return $this->hasMany(MatchUser::class);
    }
    
    /**
     * このユーザが所有する投稿。（ Postモデルとの関係を定義）
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    /**
     * このユーザが友達申請中のユーザ。（Userモデルとの関係を定義）
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withTimestamps();
    }
    
    /**
     * このユーザに友達申請中のユーザ。（Userモデルとの関係を定義）
     */
    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->withTimestamps();
    }

    
    /**
     * $userIdで指定されたユーザに友達申請する。
     *
     * @param  int  $userId
     * @return bool
     */
    public function friend($userId)
    {
        $exist = $this->is_friends($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->friends()->attach($userId);
            return true;
        }
    }
    
    /**
     * $userIdで指定されたユーザを友達解除する。
     * 
     * @param  int $usereId
     * @return bool
     */
    public function unfriend($userId)
    {
        $exist = $this->is_friends($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->friends()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     * 
     * @param  int $userId
     * @return bool
     */
    public function is_friends($userId)
    {
        return $this->friends()->where('friend_id', $userId)->exists();
    }
}
