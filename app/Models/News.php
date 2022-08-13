<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = 'news_id';

    protected $guarded = [];

    public function principal()
    {
        return $this->belongsToMany(User::class, 'news', 'news_id', 'principal');
    }

    public function sector(){
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
