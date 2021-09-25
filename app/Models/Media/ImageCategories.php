<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class ImageCategories extends Model
{
    protected $table = 'image_category';
    protected $primaryKey = "id";

    /* Count how may images have the group */
    public function Image_Count() {
        return $this->hasMany('App\Models\Media\ImageCategoryMap','image_category_id','id') ;
    }

    public function parent() {
        return $this->belongsTo('App\Models\Media\ImageCategories','parent_category_id','id') ;
    }
    

}
