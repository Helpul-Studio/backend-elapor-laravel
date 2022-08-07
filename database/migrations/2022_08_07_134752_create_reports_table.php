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
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('report_id');
            $table->enum('report_type', ['Rutin', 'Isidentil']);

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');
            
            $table->string('report_about');
            $table->string('report_source_information');
            $table->date('report_date');
            $table->string('report_place');
            $table->string('report_activities');
            $table->string('report_analysis');
            $table->string('report_prediction');
            $table->string('report_steps_taken');
            $table->string('report_recommendation');
            
            $table->unsignedBigInteger('subordinate');
            $table->foreign('subordinate')->references('user_id')->on('users');

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
        Schema::dropIfExists('reports');
    }
};
