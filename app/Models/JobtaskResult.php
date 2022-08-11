<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobtaskResult extends Model
{
    use HasFactory;
    protected $primaryKey = ['job_task_result_id'];

    protected $guarded = [];
    
    public $incrementing = false;

    public function jobtask()
    {
        return $this->belongsTo(Jobtask::class, 'job_task_id');
    }

    public function subordinate()
    {
        return $this->belongsTo(User::class, 'subordinate', 'user_id');
    }
}
