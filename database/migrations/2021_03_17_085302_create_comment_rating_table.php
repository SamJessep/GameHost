<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_rating', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('rating', ['like', 'dislike']);
            $table->string('userId');
            $table->foreignId('commentId');

            
            $table->foreign('userId')->references('username')->on('users');
            $table->foreign('commentId')->references('id')->on('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_rating');
    }
}
