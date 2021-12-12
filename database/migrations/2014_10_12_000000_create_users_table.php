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
            $table->unsignedBigInteger('family_id')->nullable()->comment('家族Id');
            $table->string('first_name')->comment('名');
            $table->string('last_name')->comment('苗字');
            $table->unsignedTinyInteger('age')->comment('年齢');
            $table->dateTime('birthday')->comment('誕生日');
            $table->tinyInteger('attribute')->comment('0: 父, 1: 母 3: 子');
            $table->string('email')->unique();
            $table->string('tel')->nullable()->comment('電話番号');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
