<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class themes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cover',
        'project_hackathon',

    ];
}
