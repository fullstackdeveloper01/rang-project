<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageColors extends Model
{

    protected $fillable = ['name','image_id']; 

    protected $table = 'image_colors';  

    /**
     * Get the user that owns the restorant.
     */
    public function image()
    {
        return $this->belongsTo('App\Images');
    }  
}
