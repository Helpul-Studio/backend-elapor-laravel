<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    protected $primaryKey = 'sector_id';

    public function jobtask()
    {
        return $this->hasMany(Jobtask::class, 'job_task_id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'news_id');
    }
}
