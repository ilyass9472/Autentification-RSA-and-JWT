<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hackathons extends Model
{
    use HasFactory;
    protected $fillable = [
        'theme_id',
        'organisateur_id',
        'name',
        'description',
        'start_date',
        'end_date',
    ];
}
