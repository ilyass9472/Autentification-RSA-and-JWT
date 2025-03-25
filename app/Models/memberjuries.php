<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memberjuries extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'code',
        'role_id',
    ];
}
