<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('match_user_id');
            $table->string('title', 20);
            $table->string('date_day');
            $table->string('place', 20);
            $table->string('image')->nullable();
            $table->string('body');
            $table->timestamps();

            // 外部キー制約を追加
            $table->foreign('match_user_id')->references('id')->on('match_users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};