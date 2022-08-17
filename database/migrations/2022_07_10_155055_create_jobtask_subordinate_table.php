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
        Schema::create('jobtask_subordinate', function (Blueprint $table) {
            $table->bigIncrements('jobtask_subordinate_id');
        
            $table->unsignedBigInteger('job_task_id');
            $table->foreign('job_task_id')->references('job_task_id')->on('jobtasks')->onDelete('cascade');

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
        Schema::dropIfExists('jobtask_subordinate');
    }
};
