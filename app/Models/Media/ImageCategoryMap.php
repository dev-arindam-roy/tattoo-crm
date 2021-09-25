<?php

namespace App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class ImageCategoryMap extends Model
{
    protected $table = 'image_category_map';
    protected $primaryKey = "id";
	public $timestamps = false;

	/* Get All details about the group */
	public function GroupInfo() {
        return $this->belongsTo('App\Models\Media\ImageCategories','image_category_id','id') ;
    }
    /* Get All details about the image */
    public function ImageInfo() {
        return $this->belongsTo('App\Models\Media\Images','image_id','id') ;
    }

    public function categoryInfo() {
        return $this->belongsTo('App\Models\Media\ImageCategories','image_category_id','id') ;
    }

    public function subcategoryInfo() {
        return $this->belongsTo('App\Models\Media\ImageCategories','image_subcategory_id','id') ;
    }

}
