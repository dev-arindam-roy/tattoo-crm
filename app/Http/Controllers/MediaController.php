<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media\ImageCategories;
use App\Models\Media\ImageCategoryMap;
use App\Models\Media\Images;
use File;
use Storage;
use Image;
use Auth;
use DB;

class MediaController extends Controller
{
    
    public function all_images() {
    	$DataBag = array();
    	$DataBag['parentMenu'] = 'tattooMng';
    	$DataBag['subMenu'] = 'tattoo';
    	$DataBag['childMenu'] = 'tattoos';
        $DataBag['groups'] = ImageCategories::where('status', '=', '1')
        ->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get();

        $query = Images::where('status', '!=', '3');

        if( isset($_GET['status']) && $_GET['status'] != '' && $_GET['status'] != '0' && $_GET['status'] != null ) {
            $query = $query->where('status', '=', trim($_GET['status']));
        } 
        if( isset($_GET['src_txt']) && $_GET['src_txt'] != '' && $_GET['src_txt'] != null ) {
            $query = $query->where( function($query) {
                $query = $query->where('name', 'like', '%'.trim($_GET['src_txt']).'%');
                $query = $query->orWhere('alt_title', 'like', '%'.trim($_GET['src_txt']).'%');
                $query = $query->orWhere('title', 'like', '%'.trim($_GET['src_txt']).'%');
            } );
        }
        if( isset($_GET['group_id']) && $_GET['group_id'] != '' && $_GET['group_id'] != '0' && $_GET['group_id'] != null ) {
            $query = $query->where( function($query) {
                $query = $query->whereHas('Group_Count', function ($query) {
                    $query->where( 'image_category_id', '=', trim($_GET['group_id']) );
                });
            } );
        }
        $allImages = $query->orderBy('id', 'desc')->paginate(25);
    	$DataBag['allImages'] = $allImages;
    	return view('dashboard.media.image.index', $DataBag);
    }

    public function add() {
    	$DataBag = array();
    	$DataBag['parentMenu'] = 'tattooMng';
    	$DataBag['subMenu'] = 'tattoo';
    	$DataBag['childMenu'] = 'tattooAddEdit';
    	
        $DataBag['allImgCats'] = ImageCategories::where('status', '!=', '3')
        ->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get();

    	return view('dashboard.media.image.add_edit', $DataBag);
    }

    public function upload(Request $request) {

    	if( $request->hasFile('images') ) {
            
    		foreach( $request->file('images') as $img ) {
    			$Images = new Images;
	    		$real_path = $img->getRealPath();
	            $file_orgname = $img->getClientOriginalName();
	            $file_size = $img->getClientSize();
	            $file_ext = strtolower($img->getClientOriginalExtension());
	            $file_newname = "media"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;

	            $destinationPath = public_path('/uploads/files/media_images');
	            $thumb_path = $destinationPath."/thumb";
	            
	            $imgObj = Image::make($real_path);
	        	$imgObj->resize(100, 100, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($thumb_path.'/'.$file_newname);

	        	$img->move($destinationPath, $file_newname);
	        	
                $Images->image = $file_newname;
	        	$Images->size = $file_size;
	        	$Images->extension = $file_ext;

                $Images->name = trim($request->input('name'));
                $Images->alt_title = trim($request->input('alt_title'));
                $Images->caption = trim($request->input('caption'));
                $Images->title = trim($request->input('title'));
                $Images->description = trim($request->input('description'));
                $Images->status = trim($request->input('status'));

	        	$Images->created_by = Auth::user()->id;
                
                if( $Images->save() ) {
                    $image_id = $Images->id;

                    $ImageCategoryMap = new ImageCategoryMap;
                    $ImageCategoryMap->image_category_id = trim( $request->input('image_category_id') );
                    $ImageCategoryMap->image_subcategory_id = 0;
                    $ImageCategoryMap->image_id = $image_id;
                    $ImageCategoryMap->save();     
                }
    		}
            
            return back()->with('msg', 'Tattoo Images Uploaded Successfully.')
            ->with('msg_class', 'alert alert-success');
    	}

    	return back();
    }

    public function imgDetails($image_id) {
        $DataBag = array();
        $DataBag['parentMenu'] = 'media';
        $DataBag['subMenu'] = 'image';
        $DataBag['childMenu'] = 'allImgs';
        $DataBag['imgInfo'] = $imgInfo = Images::findOrFail($image_id);
        $DataBag['allImgCats'] = ImageCategories::where('status', '!=', '3')
        ->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get();
        
        if( !empty($imgInfo) && isset($imgInfo->getCatSubcat) ) {
            
            $DataBag['seleSubCats'] = ImageCategories::where('status', '!=', '3')
            ->where('parent_category_id', '=', $imgInfo->getCatSubcat->image_category_id)
            ->where('parent_category_id', '!=', '0')->orderBy('name', 'asc')->get();
        }
        return view('dashboard.media.image.add_edit', $DataBag);
    }

    public function imgDetailsUpdate(Request $request, $image_id) {

        $Images = Images::find($image_id);
        if( isset($Images) && !empty($Images) ) {
            $Images->name = trim($request->input('name'));
            $Images->alt_title = trim($request->input('alt_title'));
            $Images->caption = trim($request->input('caption'));
            $Images->title = trim($request->input('title'));
            $Images->description = trim($request->input('description'));
            $Images->status = trim($request->input('status'));
            $Images->updated_by = Auth::user()->id;
            $Images->updated_at = date('Y-m-d H:i:s');

            if( $request->hasFile('image') ) {

                $img = $request->file('image');
                $real_path = $img->getRealPath();
                $file_orgname = $img->getClientOriginalName();
                $file_size = $img->getClientSize();
                $file_ext = strtolower($img->getClientOriginalExtension());
                $file_newname = "media"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;

                $destinationPath = public_path('/uploads/files/media_images');
                $thumb_path = $destinationPath."/thumb";
                
                $imgObj = Image::make($real_path);
                $imgObj->resize(200, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumb_path.'/'.$file_newname);

                $img->move($destinationPath, $file_newname);

                $Images->image = $file_newname;
                $Images->size = $file_size;
                $Images->extension = $file_ext;
            }
            
            if( $Images->save() ) {

                $ck = ImageCategoryMap::where('image_id' ,'=', $image_id)->first();
                if( !empty($ck) ) {

                    $updateArr = array();
                    $updateArr['image_category_id'] = trim( $request->input('image_category_id') );
                    $updateArr['image_subcategory_id'] = 0;
                    ImageCategoryMap::where('image_id', '=', $image_id)->update( $updateArr );
                } else { 
                    $ImageCategoryMap = new ImageCategoryMap;
                    $ImageCategoryMap->image_category_id = trim( $request->input('image_category_id') );
                    $ImageCategoryMap->image_subcategory_id = 0;
                    $ImageCategoryMap->image_id = $image_id;
                    $ImageCategoryMap->save();
                }
                    
                return back()->with('msg', 'Image Details Updated Succesfully.')->with('msg_class', 'alert alert-success');
            } 
        } 

        return back();
    }

    public function imgDelete( $image_id ) {
        $ck = Images::find($image_id);
        if( isset($ck) && !empty($ck) ) {
            $image = $ck->image;
            $res = $ck->delete();
            if( isset($res) && $res == 1 ) {
                ImageCategoryMap::where('image_id', '=', $image_id)->delete();
            }

            File::delete(['public/uploads/files/media_images/thumb/'. $image, 'public/uploads/files/media_images/'. $image]);
            return back()->with('msg', 'Tattoo Image Deleted Successfully.')->with('msg_class', 'alert alert-success');
        }

        return back();
    }

    public function imgMultiDelete(Request $request) {
        if( $request->has('imgIds') && !empty( $request->input('imgIds') ) ) {
            $imageFileArray = array();
            foreach( $request->input('imgIds') as $id ) {
                $ck = Images::find($id);
                $image = "public/uploads/files/media_images/".$ck->image;
                array_push( $imageFileArray, $image );
                $image_thumb = "public/uploads/files/media_images/thumb/".$ck->image;
                array_push( $imageFileArray, $image_thumb );
                $res = $ck->delete();
                if( isset($res) && $res == 1 ) {
                    ImageCategoryMap::where('image_id', '=', $id)->delete();
                }
            }

            File::delete($imageFileArray);
            return back()->with('msg', 'Tattoo Images Deleted Successfully.')->with('msg_class', 'alert alert-success');
        }

        return back();
    }

    public function img_categories() {
    	$DataBag = array();
    	$DataBag['parentMenu'] = 'tattooMng';
    	$DataBag['subMenu'] = 'tattoo';
    	$DataBag['childMenu'] = 'tattooCat';
    	$DataBag['allCats'] = ImageCategories::with(['parent'])->where('status', '!=', '3')->orderBy('created_at', 'desc')->get();
    	return view('dashboard.media.image.image_categories', $DataBag);
    }

    public function imgCat_Create() {
    	$DataBag = array();
    	$DataBag['parentMenu'] = 'tattooMng';
    	$DataBag['subMenu'] = 'tattoo';
    	$DataBag['childMenu'] = 'tattooCat';
        $DataBag['allFCats'] = ImageCategories::where('status', '!=', '3')->where('parent_category_id', '=', '0')->get();
    	return view('dashboard.media.image.image_category_create', $DataBag);
    }

    public function imgCat_Save(Request $request) {
    	$ImageCategories = new ImageCategories;
    	$ImageCategories->name = trim( ucfirst($request->input('name')) );
        $ImageCategories->description = trim( htmlentities( $request->input('description'), ENT_QUOTES) );

        $display_order = 0;
        if( trim($request->input('display_order')) != '' ) {
            $display_order = trim($request->input('display_order'));
        }
        $ImageCategories->display_order = $display_order;
        
        $ImageCategories->parent_category_id = 0;
        $ImageCategories->status = trim($request->input('status'));
        $ImageCategories->created_by = Auth::user()->id;
    	$res = $ImageCategories->save();
    	if( $res ) {
    		return back()->with('msg', 'Tattoo Image Category Created Successfully.')
    		->with('msg_class', 'alert alert-success');
    	} else {
    		return back()->with('msg', 'Something Went Wrong.')
    		->with('msg_class', 'alert alert-danger');
    	}

        return back();
    }

    public function imgCat_Edit($id) {
    	$DataBag = array();
    	$DataBag['parentMenu'] = 'tattooMng';
    	$DataBag['subMenu'] = 'tattoo';
    	$DataBag['childMenu'] = 'tattooCat';
    	$DataBag['imgcat'] = ImageCategories::findOrFail($id);
        $DataBag['allFCats'] = ImageCategories::where('status', '!=', '3')->where('parent_category_id', '=', '0')
        ->where('id', '!=', $id)->get();
    	return view('dashboard.media.image.image_category_create', $DataBag);
    }

    public function imgCat_Update(Request $request, $id) {
    	$ImageCategories = ImageCategories::find($id);
    	$ImageCategories->name = trim( ucfirst($request->input('name')) );
        $ImageCategories->description = trim($request->input('description'));

        $display_order = 0;
        if( trim($request->input('display_order')) != '' ) {
            $display_order = trim($request->input('display_order'));
        }
        $ImageCategories->display_order = $display_order;
        
        $ImageCategories->parent_category_id = 0;
        $ImageCategories->status = trim($request->input('status'));
        $ImageCategories->updated_by = Auth::user()->id;
        if( $ImageCategories->save() ) {
            
            return back()->with('msg', 'Tattoo Image Category Updated Successfully.')
            ->with('msg_class', 'alert alert-success');
        }
        return back()->with('msg', 'Something Went Wrong')
        ->with('msg_class', 'alert alert-danger');
    }

    public function imgCat_Delete($id) {
    	$res = ImageCategories::findOrFail($id);
    	$res->status = '3';
    	$del = $res->save(); 
    	if( $res ) {
            ImageCategoryMap::where('image_category_id', '=', $id)->orWhere('image_subcategory_id', '=', $id)->delete();
    		return back()->with('msg', 'Tattoo Image Category Deleted Successfully.')
    		->with('msg_class', 'alert alert-success');
    	} else {
    		return back()->with('msg', 'Something Went Wrong.')
    		->with('msg_class', 'alert alert-danger');
    	}
    }

}
