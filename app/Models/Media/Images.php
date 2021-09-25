<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'image';
    protected $primaryKey = "id";

    /* One Image belongs to how many galleries */
    public function Gallery_Count() {
        return $this->hasMany('App\Models\Media\ImageGalleryMap','image_id','id') ;
    }
    
    /* One Image belongs to how many groups */
    public function Group_Count() {
        return $this->hasMany('App\Models\Media\ImageCategoryMap','image_id','id') ;
    }

    public function userInfo() {
        return $this->belongsTo('App\Models\Users','created_by','id') ;
    }

    public function getCatSubcat() {
        return $this->hasOne('App\Models\Media\ImageCategoryMap','image_id','id') ;
    }

}
