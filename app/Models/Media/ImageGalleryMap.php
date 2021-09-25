<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class ImageGalleryMap extends Model
{
    protected $table = 'image_gallery_map';
    protected $primaryKey = "id";
	public $timestamps = false;

	/* Get All details about the gallery */
	public function GalleryInfo() {
        return $this->belongsTo('App\Models\Media\ImageGalleries','image_gallery_id','id') ;
    }

}
