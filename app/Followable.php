<?php

namespace App;

// Userクラスにて利用
trait Followable
{
    // フォローする(クリックしたユーザーのidをuser_idに、クイックされたユーザーのidをfollowing_user_idに保存)
    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function following()
    {
        //
    }

    // フォローしているユーザー一覧表示
    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',  // 中間テーブル名
            'user_id',  // 自分のカラム名
            'following_user_id' // 相手のカラム名
        ); // memo: belongsToManyの定義に飛ぶとわかりやすい！
    }
}