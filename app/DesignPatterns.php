<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignPatterns extends Model
{

    protected $fillable = ['name', 'user_id', 'status']; 

    protected $table = 'design_patterns';  

    public $timestamps = false;

    /**
     * Get the user that owns the restorant.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  
}
