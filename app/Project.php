<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name','project_creator','past'
    ];
    protected $hidden = [
        'remember_token',
    ];
}
