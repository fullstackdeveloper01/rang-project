<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersMaterials extends Model
{

    protected $fillable = ['user_id', 'material_id'];
 
    protected $table='users_material'; 

     
    public function get_manufacturer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
}
