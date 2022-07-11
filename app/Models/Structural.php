<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structural extends Model
{
    use HasFactory;

    protected $primaryKey = 'structural_id';

    protected $fillable = [
        'principal', 'subordinate'
    ];
}
