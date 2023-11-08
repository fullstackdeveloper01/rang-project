<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{

    protected $fillable = ['buyer_id', 'status', 'fabric_type', 'width_type', 'open_width_inches', 'tubular_inches', 'gsm_count', 'measurement', 'design_quantity', 'total_quantity'];
 
    protected $table='user_request'; 

     
    public function get_fabric()
    {
        return $this->belongsTo('App\Materials', 'fabric_type');
    } 
    public function get_manufacturer()
    {
        return $this->belongsTo('App\User', 'manufacturer_id');
    } 

    public function get_buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id');
    } 
     
    public function image()
    {
        return $this->belongsTo('App\Images', 'image_id');
    } 

    public function get_requestItmes()
    {
        return  $this->hasMany('App\UserRequestItems', 'request_id');
    }

    public function get_requestManufacturer()
    {
        return  $this->hasMany('App\UserRequestManufacturer', 'request_id');
    }
      
}
