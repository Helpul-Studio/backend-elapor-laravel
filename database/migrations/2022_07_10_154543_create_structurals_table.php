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
        Schema::create('structurals', function (Blueprint $table) {
            $table->bigIncrements('structural_id');
            $table->unsignedBigInteger('principal');
            $table->foreign('principal')->references('user_id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('subordinate');
            $table->foreign('subordinate')->references('user_id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('structurals');
    }
};
