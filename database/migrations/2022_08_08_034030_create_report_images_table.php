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
        Schema::create('report_images', function (Blueprint $table) {
            $table->bigIncrements('report_image_id');
        
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');

            $table->string('report_documentation');
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
        Schema::dropIfExists('report_images');
    }
};
