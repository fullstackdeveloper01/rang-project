<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageDesignPatterns extends Model
{

    protected $fillable = ['name','image_id']; 

    protected $table = 'image_design_patterns';  

    /**
     * Get the user that owns the restorant.
     */
    public function image()
    {
        return $this->belongsTo('App\Images');
    }  
}
