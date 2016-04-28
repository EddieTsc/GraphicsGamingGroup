<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'pdf_name','pathFile','ID_Author','ID_Project'
    ];
    protected $hidden = [
        'remember_token',
    ];
}