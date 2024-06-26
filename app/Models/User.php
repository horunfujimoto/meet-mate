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
     * $user_idで指定されたユーザに友達申請する。
     *
     * @param  int  $user_id
     * @return bool
     */
    public function friend($user_id)
    {
        $exist = $this->is_friends($user_id);
        $its_me = $this->id == $user_id;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->friends()->attach($user_id);
            return true;
        }
    }
    
    /**
     * $user_idで指定されたユーザを友達解除する。
     * 
     * @param  int $usereId
     * @return bool
     */
    public function unfriend($user_id)
    {
        $exist = $this->is_friends($user_id);
        $its_me = $this->id == $user_id;
        
        if ($exist && !$its_me) {
            $this->friends()->detach($user_id);
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 指定された$user_idのユーザをこのユーザが友達申請中であるか調べる。
     * 
     * @param  int $user_id
     * @return bool
     */
    public function is_friends($user_id)
    {
        return $this->friends()->where('friend_id', $user_id)->exists();
    }
    
    /**
     * 
     *相互で友達申請をしている場合
     */
    public function myfriends()
    {
        return $this->friends()->whereHas('friends', function ($query) {
            $query->where('friend_id', $this->id);
        });
    }
    
    /**
     * いいね（ Postモデルとの関係を定義）
     */
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }
    
    /**
     * 指定されたpostをいいねする。
     */
    public function favorite($post_id)
    {
        $exist = $this->is_favorite($post_id);

        // すでにいいねに追加されているかチェック
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($post_id);
            return true;
        }
    }

    /**
     * 指定されたpostのいいねを解除する。
     */
    public function unfavorite($post_id)
    {
        $exist = $this->is_favorite($post_id);

        // お気に入りから削除
        if ($exist) {
            $this->favorites()->detach($post_id);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 指定されたpostがいいねに追加されているかチェックする。
     */
    public function is_favorite($post_id)
    {
        return $this->favorites()->where('post_id', $post_id)
                                ->where('favorites.user_id', $this->id)
                                ->exists();
    }
    
    /**
     * コメント（commentモデルとの関係を定義）
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
