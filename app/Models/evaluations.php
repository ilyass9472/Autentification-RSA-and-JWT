<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluations extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'project_id',
        'jury_id',
        'score',
        'commentaire',
    ];
}
