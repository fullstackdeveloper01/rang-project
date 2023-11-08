<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequestItems extends Model
{

    protected $fillable = ['manufacturer_id', 'image_id', 'quantity', 'request_id', 'status', 'accept_manufacturer_id'];
 
    protected $table='request_items'; 
 
    public function get_request()
    {
        return $this->belongsTo('App\UserRequest', 'request_id');
    }

    public function get_manufacturer()
    {
        return $this->belongsTo('App\User', 'manufacturer_id');
    } 

    public function get_accept_manufacturer()
    {
        return $this->belongsTo('App\User', 'accept_manufacturer_id');
    }  
 
    public function get_image()
    {
        return $this->belongsTo('App\Images', 'image_id');
    } 
      
}
