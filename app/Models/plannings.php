<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plannings extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'hackathon_id',
        
    ];
}
