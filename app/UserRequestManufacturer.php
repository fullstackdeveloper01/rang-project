<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequestManufacturer extends Model
{

    protected $fillable = ['manufacturer_id', 'request_id', 'status', 'is_accept', 'accept_date'];
 
    protected $table='request_manufacturer'; 

    public $timestamps = false; 
     
    public function get_manufacturer()
    {
        return $this->belongsTo('App\User', 'manufacturer_id');
    }  

    public function get_request()
    {
        return $this->belongsTo('App\UserRequest', 'request_id');
    }
}
