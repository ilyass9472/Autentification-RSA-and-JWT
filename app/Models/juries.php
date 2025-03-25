<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class juries extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'team_id',
    ];
}
