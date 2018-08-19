<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_entry', function (Blueprint $table) {
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('idea_id')->references('id')->on('ideas');
            $table->increments('id');
            $table->longText('message');
            $table->string('title');
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
        Schema::dropIfExists('discussion_entry');
    }
}
