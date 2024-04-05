<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Way;

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
    
    }
}