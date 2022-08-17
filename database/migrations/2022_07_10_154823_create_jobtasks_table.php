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
        Schema::create('jobtasks', function (Blueprint $table) {
            $table->bigIncrements('job_task_id');

            $table->unsignedBigInteger('principal');
            $table->foreign('principal')->references('user_id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('sector_id')->on('sectors')->onDelete('cascade');

            $table->string('job_task_name');
            $table->date('job_task_date');
            $table->string('job_task_place');

            $table->enum('job_task_status', ['Ditugaskan', 'Menunggu Konfirmasi', 'Ditolak', 'Selesai'])->default('Ditugaskan');
            $table->string('job_task_note')->nullable();
            $table->enum('job_task_rating', [5, 4, 3, 2, 1])->nullable();
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
        Schema::dropIfExists('jobtasks');
    }
};
