<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtask extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_task_id';

    protected $fillable = [
        'user_id', 'job_task_name', 'job_task_date', 'job_task_status'
    ];
}
