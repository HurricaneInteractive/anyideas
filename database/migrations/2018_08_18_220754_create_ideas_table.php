<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->increments('id');
            $table->string('title');
            $table->boolean('success')->default(false);
            $table->mediumText('pitch');
            $table->string('status');
            $table->string('category');
            $table->mediumText('tags')->nullable();
            $table->longText('description');
            $table->mediumInteger('darts')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['category', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}
