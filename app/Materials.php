<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{

    protected $fillable = ['name', 'slug', 'status'];
 
    protected $table='materials'; 
 
}
