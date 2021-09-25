<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class ImageGalleries extends Model
{
    protected $table = 'image_gallery';
    protected $primaryKey = "id";

    /* Count how may images have the gallery */
    public function Image_Count() {
        return $this->hasMany('App\Models\Media\ImageGalleryMap','image_gallery_id','id') ;
    }

	public function GroupInfo() {
        return $this->belongsTo('App\Models\Media\ImageCategories','image_category_id','id') ;
    }    
}
