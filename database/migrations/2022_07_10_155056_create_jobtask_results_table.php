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
        Schema::create('jobtask_results', function (Blueprint $table) {
            $table->bigIncrements('job_task_result_id');

            $table->enum('report_type', ['Rutin', 'Isidentil']);

            $table->unsignedBigInteger('report_task_id')->nullable();

            $table->unsignedBigInteger('job_task_id')->nullable();
            $table->foreign('job_task_id')->references('job_task_id')->on('jobtasks')->onDelete('cascade');
            
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');

            $table->unsignedBigInteger('subordinate');
            $table->foreign('subordinate')->references('user_id')->on('users');
            
            $table->decimal('location_latitude', 10, 7)->nullable();
            $table->decimal('location_longitude', 10, 7)->nullable();
            $table->string('jobtask_documentation');

            $table->string('report_about')->nullable();
            $table->string('report_source_information')->nullable();
            $table->date('report_date')->nullable();
            $table->string('report_place')->nullable();

            $table->string('report_activities')->nullable();
            $table->string('report_analysis')->nullable();
            $table->string('report_prediction')->nullable();
            $table->string('report_steps_taken')->nullable();
            $table->string('report_recommendation')->nullable();

            $table->string('report_note')->nullable();

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
        Schema::dropIfExists('jobtask_results');
    }
};
