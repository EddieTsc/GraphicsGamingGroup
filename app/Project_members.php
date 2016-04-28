<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_members extends Model
{
    protected $fillable = [
        'member_id','project_id'
    ];
    protected $hidden = [
        'remember_token',
    ];
}
