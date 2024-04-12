<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Way;
use App\Models\User;
use App\Models\MatchUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $ways = [
            ['way' => '★ほかの出会い方を登録する'],
            ['way' => '職場'],
            ['way' => '学校'],
            ['way' => 'バイト'],
            ['way' => 'マッチングアプリ'],
            ['way' => '合コン'],
            ['way' => 'SNS'],
            ['way' => 'ナンパ'],
            ['way' => '紹介'],
            ['way' => '恋活イベント'],
            ['way' => '婚活イベント'],
        ];
    
        // シーディングされたデータをデータベースに挿入
        Way::insert($ways);
        
        // 下記テストデータ
        // $users = [
        //     ['name' => 'ねこ', 'email'=> '000@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'たぬき', 'email'=> '111@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'いぬ', 'email'=> '222@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'ねずみ', 'email'=> '333@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'うさぎ', 'email'=> '444@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'りす', 'email'=> '555@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'へび', 'email'=> '666@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'たつ', 'email'=> '777@co.jp','password'=> bcrypt('password')],
        //     ['name' => 'いのしし', 'email'=> '888@co.jp','password'=> bcrypt('password')],
        // ];
        
        // // シーディングされたデータをデータベースに挿入
        // User::insert($users);
        
        // // Way_id と other_way の値を設定
        // foreach ($users as $index => $user) {
        //     $wayId = $index + 1; // User_id と同じにする
        //     $otherWay = $wayId == 1 ? 'その他' : null;

        //     // マッチユーザーを作成
        //     MatchUser::create([
        //         'user_id' => $wayId,
        //         'way_id' => $wayId,
        //         'name' => $user['name'],
        //         'age' => 30,
        //         'feeling' => 80,
        //         'address' => '住んでる場所',
        //         'work' => '仕事',
        //         'birthday' => null,
        //         'sns' => 'SNS',
        //         'others' => 'その他情報',
        //         'image' => null,
        //         'other_way' => $otherWay,
        //     ]);
        // }
    }
}