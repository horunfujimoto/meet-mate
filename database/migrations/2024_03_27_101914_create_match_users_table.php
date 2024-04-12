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
        Schema::create('match_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('way_id');
            $table->string('name', 20);
            $table->integer('age');
            $table->integer('feeling');
            $table->string('address', 10);
            $table->string('work', 10);
            $table->string('birthday')->nullable();
            $table->string('sns')->nullable();
            $table->string('others', 50)->nullable();
            $table->string('image')->nullable();
            $table->string('other_way', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_users');
    }
};
