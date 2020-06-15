<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // memo: get〇〇Attributeで呼び出す時は $user->〇〇 でいける！
    public function getAvatarAttribute()
    {
        return "https://i.pravatar.cc/200?u=".$this->email;
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->latest();
    }


    // 自分と自分がフォローしているユーザーの投稿のみ表示
    public function timeline()
    {
        // return Tweet::where('user_id', $this->id)->latest()->get();
        $ids = $this->follows()->pluck('id');
        $ids->push($this->id);

        return Tweet::whereIn('user_id', $ids)->latest()->get();
    }

    // memo: ルートのパラメーターでレコードを識別するパラメーターのカラムを設定
    // 追記: web.phpに {user:name} とすればいらない(62より)
    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
}
