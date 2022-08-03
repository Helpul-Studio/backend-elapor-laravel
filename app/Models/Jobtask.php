<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobtask extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_task_id';

    protected $guarded = [];

    public $incrementing = false;

    public function principal()
    {
        return $this->belongsToMany(User::class, 'jobtasks', 'job_task_id', 'principal');
    }

    public function subordinate()
    {
        return $this->belongsToMany(User::class, 'jobtasks', 'job_task_id', 'subordinate');
    }

    public function jobtaskResult()
    {
        return $this->hasMany(JobtaskResult::class, 'job_task_id');
    }
}
