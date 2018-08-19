<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimelineEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_entry', function (Blueprint $table) {
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('idea_id')->references('id')->on('ideas');
            $table->increments('id');
            $table->string('title');
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
        Schema::dropIfExists('timeline_entry');
    }
}
