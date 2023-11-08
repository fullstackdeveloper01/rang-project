<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{

    protected $fillable = ['name','logo', 'user_id', 'color_code','pattern','status','description'];
    protected $appends = ['icon'];
    protected $imagePath='/uploads/images/';

    protected function getImge($imageValue,$default,$version="_large.jpg"){
        if($imageValue==""||$imageValue==null){
            //No image
            return $default;
        }else{
            if(strpos($imageValue, 'http') !== false){
                //Have http
                if(strpos($imageValue, '.jpg') !== false||strpos($imageValue, '.jpeg') !== false||strpos($imageValue, '.png') !== false){
                    //Has extension
                    return $imageValue;
                }else{
                    //No extension
                    return $imageValue.$version;
                }
            }else{
                //Local image
                return ($this->imagePath.$imageValue).$version;
            }
        }
    }

    public function colors(){
        return $this->hasMany(ImageColors::class, 'image_id'); 
    }

    public function patterns(){
        return $this->hasMany(ImageDesignPatterns::class, 'image_id');  
    }
    
    public function getColors(){
        return $this->hasMany('App\ImageColors', 'image_id')->leftJoin('colors', 'image_colors.color_id', '=', 'colors.id')->select('image_colors.color_id as id', 'colors.name');
    }

    public function getPatterns(){
        return $this->hasMany('App\ImageDesignPatterns', 'image_id')->leftJoin('design_patterns', 'image_design_patterns.pattern_id', '=', 'design_patterns.id')->select('image_design_patterns.pattern_id as id', 'design_patterns.name');
    }

    /**
     * Get the user that owns the restorant.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
 
    public function getImageAttribute()
    {
        return $this->getImge($this->logo,str_replace("_large.jpg","_thumbnail.jpg",config('global.restorant_details_image')),"_thumbnail.jpg");
    } 
      
}
