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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('job_task_documentation');
            $table->enum('job_task_rating', [5, 4, 3, 2, 1]);
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
