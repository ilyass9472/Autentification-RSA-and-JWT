<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'theme_id', 
        'start_date', 
        'end_date', 
        'organisateur_id'
    ];

    protected $dates = [
        'start_date', 
        'end_date'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function organisateur()
    {
        return $this->belongsTo(User::class, 'organisateur_id');
    }
}

class Theme extends Model
{
    protected $fillable = [
        'name', 
        'cover'
    ];

    public function hackathons()
    {
        return $this->hasMany(Hackathon::class);
    }
}

class Rule extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'hackathon_id'
    ];

    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class);
    }
}