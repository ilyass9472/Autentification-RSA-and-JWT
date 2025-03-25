<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activites extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'description',
        'date',
    ];
}
