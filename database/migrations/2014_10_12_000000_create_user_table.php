<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->string('name');
                $table->string('username')->primary();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('picture');
                $table->boolean('isDev');
                $table->dateTime('email_verified_at')->nullable();
                $table->rememberToken();
                $table->timestamps();
    
                $table->string('about')->default('');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
