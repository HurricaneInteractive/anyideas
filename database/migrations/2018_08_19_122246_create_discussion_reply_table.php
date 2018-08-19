<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_reply', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->unsignedInteger('idea_id');
            $table->foreign('idea_id')->references('id')->on('ideas');

            $table->unsignedInteger('discussion_id');
            $table->foreign('discussion_id')->references('id')->on('discussion_entry');

            $table->increments('id');
            $table->mediumText('message');
            $table->mediumInteger('darts')->default('0');
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
        Schema::dropIfExists('discussion_reply');
    }
}
