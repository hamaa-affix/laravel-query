<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_id');
            $table->string('name', 64)->comment('会社名');
            $table->string('subject', 1000)->nullable()->comment('会社概要');
            $table->string('company_url')->nullable()->comment('会社url');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('image_id')
                    ->references('id')
                    ->on('images')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
