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
        
            $table->unsignedBigInteger('job_task_id');
            $table->foreign('job_task_id')->references('job_task_id')->on('jobtasks');


            $table->decimal('location_latitude', 10, 7)->nullable();;
            $table->decimal('location_longitude', 10, 7)->nullable();;
            $table->string('jobtask_documentation');
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
