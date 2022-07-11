<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobtaskResult extends Model
{
    use HasFactory;

    protected $primaryKey = ['job_task_result_id'];

    protected $fillable = [
        'job_task_id', 'user_id', 'job_task_documentation', 'job_task_rating'
    ];
}
