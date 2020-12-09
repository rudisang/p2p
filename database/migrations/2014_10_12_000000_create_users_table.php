<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->boolean('isAdmin');
            $table->boolean('isUser');
            $table->string('gender');
            $table->Integer('omang');
            $table->string('occupation');
            $table->Integer('salary')->nullable();
            $table->string('employer')->nullable();
            $table->string('employer_email')->nullable();
            $table->Integer('phone');
            $table->string('address');
            $table->string('residence');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
