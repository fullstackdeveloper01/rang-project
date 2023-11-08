<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{

    protected $fillable = ['name', 'code', 'user_id', 'status']; 

    protected $table = 'colors';  

    public $timestamps = false;

    /**
     * Get the user that owns the restorant.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
}
