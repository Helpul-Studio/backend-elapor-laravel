<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('news_title');
            $table->string('news_field');
            $table->string('news_image')->nullable();
            
            $table->unsignedBigInteger('principal');
            $table->foreign('principal')->references('user_id')->on('users');

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');

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
        Schema::dropIfExists('news');
    }
};
