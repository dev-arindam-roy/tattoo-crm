<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsLinks;
use App\Models\Media\ImageCategories;
use App\Models\Media\ImageCategoryMap;
use App\Models\Media\ImageGalleries;
use App\Models\Media\ImageGalleryMap;
use App\Models\Media\Images;
use App\Models\ReusableContent;
use App\Models\FrmBuilder\FrmMaster;
use App\Models\Media\FilesMaster;
use App\Models\Media\FileCategories;
use App\Models\Media\FileCategoriesMap;
use App\Models\Media\Videos;
use App\Models\Media\VideoCategories;
use App\Models\Media\VideoCategoriesMap;
use File;
use Image;
use Auth;
use DB;

class AjaxElementController extends Controller
{
    
    public function mediaImageUpload(Request $request) {
        $rtn = array();
        $uploadImgsIds = array();
        if( $request->hasFile('images') ) {
            foreach( $request->file('images') as $img ) {
                $arr = array();
                $Images = new Images;
                $real_path = $img->getRealPath();
                $file_orgname = $img->getClientOriginalName();
                $file_size = $img->getClientSize();
                $file_ext = strtolower($img->getClientOriginalExtension());
                $file_newname = "media"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;

                $destinationPath = public_path('/uploads/files/media_images');
                $thumb_path = $destinationPath."/thumb";
                
                $imgObj = Image::make($real_path);
                $imgObj->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumb_path.'/'.$file_newname);

                $img->move($destinationPath, $file_newname);
                $Images->image = $file_newname;
                $Images->size = $file_size;
                $Images->extension = $file_ext;
                $Images->created_by = Auth::user()->id;
                if( $Images->save() ) {
                    array_push( $uploadImgsIds, $Images->id );
                } 
            }
        }
        if( !empty($uploadImgsIds) ) {
            return json_encode( $uploadImgsIds );
        }
        return json_encode( $rtn );
    }

    public function mediaImageLibrary(Request $request) {
        $query = Images::where('status', '=', '1');
        if( isset($_GET['src_txt']) && $_GET['src_txt'] != '' && $_GET['src_txt'] != null ) {
            $query = $query->where( function($query) {
                $query = $query->where('name', 'like', '%'.trim($_GET['src_txt']).'%');
                $query = $query->orWhere('alt_title', 'like', '%'.trim($_GET['src_txt']).'%');
            } );
        }
        if( isset($_GET['gallery_id']) && $_GET['gallery_id'] != '' && $_GET['gallery_id'] != '0' && $_GET['gallery_id'] != null ) {
            $query = $query->where( function($query) {
                $query = $query->whereHas('Group_Count', function ($query) {
                    $query->where( 'image_category_id', '=', trim($_GET['gallery_id']) );
                });
            } );
        }
        $allImages = $query->orderBy('created_at', 'desc')->paginate(12);
        return view('dashboard.media.image.render_image', compact('allImages'));
    }

    public function mediaLoadImageGalleries() {
        $data = ImageCategories::where('status', '=', '1')->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function eleShortCodes(Request $request) {

        $ReusableContent = ReusableContent::where('status', '=', '1')->orderBy('created_at', 'desc')
        ->select('id', 'name', 'short_code')->get();

        $view_rc = view( 'dashboard.any_render', array('ReusableContent' => $ReusableContent) )->render();

        $FrmBuilder = FrmMaster::where('status', '=', '1')->orderBy('created_at', 'desc')
        ->select('id', 'frm_heading', 'frm_scode')->get();
        
        $view_frm = view( 'dashboard.any_render', array('FrmBuilder' => $FrmBuilder) )->render();

        $imgGals = ImageGalleries::where('status', '=', '1')->orderBy('created_at', 'desc')
        ->select('id', 'name', 'short_code')->get();
        
        $view_gal = view( 'dashboard.any_render', array('imgGals' => $imgGals) )->render();

        return response()->json(['html_rc' => $view_rc, 'html_frm' => $view_frm, 'html_gal' => $view_gal, 'status' => 'ok']);
    }

    public function mediaFileUpload(Request $request) {

        $uploadFilesIds = array();
        $categoriesArray = array();

        if( $request->hasFile('brochure') ) {

            $a4_file_id = 0;
            $letter_file_id = 0;

            $name = trim( $request->input('name') );
            $title = trim( $request->input('title') );
            $caption = trim( $request->input('caption') );
            $details = trim( $request->input('details') );
            
            $file_category_id = trim( $request->input('file_category_id') );
            $file_subcategory_id = trim( $request->input('file_subcategory_id') );

            if( $request->hasFile('a4file') ) {
                $a4file = $request->file('a4file');
                $real_path = $a4file->getRealPath();
                $file_orgname = $a4file->getClientOriginalName();
                $file_size = $a4file->getClientSize();
                $file_ext = strtolower($a4file->getClientOriginalExtension());
                $file_newname = "file"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;
                $destinationPath = public_path('/uploads/files/media_files');
                $a4file->move($destinationPath, $file_newname);
                $FilesMaster = new FilesMaster;
                $FilesMaster->file = $file_newname;
                $FilesMaster->size = $file_size;
                $FilesMaster->extension = $file_ext;
                $FilesMaster->created_by = Auth::user()->id;
                if( $FilesMaster->save() ) {
                    $a4_file_id = $FilesMaster->id;
                }
            }

            if( $request->hasFile('letterfile') ) {
                $letterfile = $request->file('letterfile');
                $real_path = $letterfile->getRealPath();
                $file_orgname = $letterfile->getClientOriginalName();
                $file_size = $letterfile->getClientSize();
                $file_ext = strtolower($letterfile->getClientOriginalExtension());
                $file_newname = "file"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;
                $destinationPath = public_path('/uploads/files/media_files');
                $letterfile->move($destinationPath, $file_newname);
                $FilesMaster = new FilesMaster;
                $FilesMaster->file = $file_newname;
                $FilesMaster->size = $file_size;
                $FilesMaster->extension = $file_ext;
                $FilesMaster->created_by = Auth::user()->id;
                if( $FilesMaster->save() ) {
                    $letter_file_id = $FilesMaster->id;
                }
            }

            foreach( $request->file('brochure') as $file ) {
                $FilesMaster = new FilesMaster;
                $real_path = $file->getRealPath();
                $file_orgname = $file->getClientOriginalName();
                $file_size = $file->getClientSize();
                $file_ext = strtolower($file->getClientOriginalExtension());
                $file_newname = "file"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;
                $destinationPath = public_path('/uploads/files/media_files');
                $file->move($destinationPath, $file_newname);
                
                $FilesMaster->file = $file_newname;
                $FilesMaster->size = $file_size;
                $FilesMaster->extension = $file_ext;
                $FilesMaster->name = $name;
                $FilesMaster->title = $title;
                $FilesMaster->caption = $caption;
                $FilesMaster->details = $details;
                $FilesMaster->a4_file_id = $a4_file_id;
                $FilesMaster->letter_file_id = $letter_file_id;
                
                $FilesMaster->created_by = Auth::user()->id;

                if( $FilesMaster->save() ) {
                    $file_id = $FilesMaster->id;
                    array_push($uploadFilesIds, $file_id);

                    $arr = array();
                    $arr['file_id'] = $file_id;
                    $arr['file_category_id'] = $file_category_id;
                    $arr['file_subcategory_id'] = $file_subcategory_id;
                    array_push($categoriesArray, $arr);
                }
            }

            if(!empty($categoriesArray)) {
                FileCategoriesMap::insert($categoriesArray);   
            }
        }
        return json_encode( $uploadFilesIds );
    }

    public function getMediaFiles(Request $request) {

        $query = FilesMaster::where('status', '!=', '3');

        if( isset($_GET['src_txt']) && $_GET['src_txt'] != '' && $_GET['src_txt'] != null ) {
            $query = $query->where('name', 'like', '%'.trim($_GET['src_txt']).'%');
        }
        if( isset($_GET['category_id']) && $_GET['category_id'] != '' && $_GET['category_id'] != '0' && $_GET['category_id'] != null ) {
            $query = $query->whereHas('Categories', function ($query) {
                $query->where( 'file_category_id', '=', trim($_GET['category_id']) );
            });
        }
        
        $allFiles = $query->orderBy('created_at', 'desc')->paginate(25);
        return view('dashboard.media.file.render_files', compact('allFiles'));
    }

    public function mediaLoadFileCategories() {
        $data = FileCategories::where('status', '=', '1')->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function mediaLoadImgCategories() {
        $data = ImageCategories::where('status', '=', '1')->where('parent_category_id', '=', '0')->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function mediaLoadFileSubCategories(Request $request) {
        $cat_id = trim( $request->input('cat_id') );
        $data = FileCategories::where('status', '=', '1')->where('parent_category_id', '!=', '0')
        ->where('parent_category_id', '=', $cat_id)->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function mediaLoadVidSubCategories(Request $request) {
        $cat_id = trim( $request->input('cat_id') );
        $data = VideoCategories::where('status', '=', '1')->where('parent_category_id', '!=', '0')
        ->where('parent_category_id', '=', $cat_id)->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function mediaLoadFileSubCategoriesSlug(Request $request) {
        $data = array();
        $slug = trim( $request->input('slug') );
        $ck = FileCategories::where('slug', '=', $slug)->first();
        if( !empty($ck) ) {
            $data = FileCategories::where('status', '=', '1')->where('parent_category_id', '!=', '0')
            ->where('parent_category_id', '=', $ck->id)->orderBy('name', 'asc')->get()->toJson();
        }
        return $data;
    }

    public function mediaLoadImgSubCategoriesSlug(Request $request) {
        $data = array();
        $slug = trim( $request->input('slug') );
        $ck = ImageCategories::where('slug', '=', $slug)->first();
        if( !empty($ck) ) {
            $data = ImageCategories::where('status', '=', '1')->where('parent_category_id', '!=', '0')
            ->where('parent_category_id', '=', $ck->id)->orderBy('name', 'asc')->get()->toJson();
        }
        return $data;
    }

    public function mediaLoadImageSubCategories(Request $request) {
        $cat_id = trim( $request->input('cat_id') );
        $data = ImageCategories::where('status', '=', '1')->where('parent_category_id', '!=', '0')
        ->where('parent_category_id', '=', $cat_id)->orderBy('name', 'asc')->get()->toJson();
        return $data;
    }

    public function mediaVideoAdd(Request $request) {

        $rtnArr = array();

        $Videos = new Videos;
        $Videos->name = trim( ucfirst($request->input('name')) );
        $Videos->title = trim( ucfirst($request->input('title')) );
        $Videos->slug = str_slug( trim($request->input('name')) , '-' );
        $Videos->video_type = trim($request->input('video_type'));
        $Videos->short_code = "[#Video_".md5(microtime(TRUE).rand(123,999))."]";
        $youtubeVideo = explode( '?v=', trim($request->input('link_script')) );
        if( trim($request->input('video_type')) == '1' && !empty($youtubeVideo) ) {
            $Videos->video_link = end( $youtubeVideo );    
        }
        if( trim($request->input('video_type')) == '2' ) {
            $Videos->video_script = htmlentities( trim($request->input('link_script')), ENT_QUOTES );   
        }
        $Videos->video_caption = trim($request->input('video_caption'));

        if( $Videos->save() ) {
            $video_id = $Videos->id;

            $CmsLinks = new CmsLinks;
            $CmsLinks->table_id = $video_id;
            $CmsLinks->slug_url = trim($request->input('slug'));
            $CmsLinks->table_type = 'VIDEO';
            $CmsLinks->save();

            $rtnArr['video_id'] = $video_id;
            $rtnArr['isSuccess'] = 'success';
        } else {
            $rtnArr['isSuccess'] = 'error';
        }

        return json_encode( $rtnArr );
    }

    public function mediaVideoLibrary(Request $request) {

        $query = Videos::where('status', '=', '1');
        if( isset($_GET['src_txt']) && $_GET['src_txt'] != '' && $_GET['src_txt'] != null ) {
            $query = $query->where( function($query) {
                $query = $query->where('name', 'like', '%'.trim($_GET['src_txt']).'%');
                $query = $query->orWhere('video_caption', 'like', '%'.trim($_GET['src_txt']).'%');
                $query = $query->orWhere('title', 'like', '%'.trim($_GET['src_txt']).'%');
            } );
        }
        $allVideo = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.media.video.render_video', compact('allVideo'));
    }
}
