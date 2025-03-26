<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'hackathon_id',
    ];
}