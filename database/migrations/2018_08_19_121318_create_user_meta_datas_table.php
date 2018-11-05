<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta_datas', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->increments('id');
            $table->string('occupation')->nullable();
            $table->string('website')->nullable();
            $table->mediumText('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->mediumText('following')->nullable(); // IDEAS YOU FOLLOW
            $table->mediumText('followers')->nullable(); // PEOPLE FOLLOWING YOUR IDEAS / SUPPORTERS
            $table->mediumText('likes')->nullable(); // object of [discussion, discussion replies, updates, timelines, ideas] likes
            $table->mediumText('social_media')->nullable();
            $table->mediumText('interests')->nullable();
            $table->timestamps();

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta_datas');
    }
}
