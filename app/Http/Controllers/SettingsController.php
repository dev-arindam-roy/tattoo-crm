<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use Image;
use Auth;
use DB;

class SettingsController extends Controller
{
    public function generalSettings() {
    	$dataBag = array();
    	$dataBag['parentMenu'] = "settings";
    	$dataBag['childMenu'] = "genSett";
    	$dataBag['tmzList'] = array();
    	$dataBag['settings'] = GeneralSettings::where('id', '=', '1')->first();

    	return view('dashboard.settings.general_settings', $dataBag);
    }

    public function saveGeneralSettings(Request $request) {

    	$isExist = GeneralSettings::where('id', '=', '1')->first();
    	if( empty($isExist) ) {
	    	$GeneralSettings = new GeneralSettings;
	    	$GeneralSettings->site_name = trim($request->input('site_name'));
	    	$GeneralSettings->site_tagline = trim($request->input('site_tagline'));
	    	$GeneralSettings->site_description = trim($request->input('site_description'));
	    	//$GeneralSettings->display_per_page = trim($request->input('display_per_page'));
	    	$GeneralSettings->site_footer_text = trim($request->input('site_footer_text'));
	    	//$GeneralSettings->date_format = trim($request->input('date_format'));
	    	//$GeneralSettings->timezone_id = trim($request->input('timezone_id'));
	    	$GeneralSettings->site_name = trim($request->input('site_name'));
	    	$GeneralSettings->site_name = trim($request->input('site_name'));
	    	$search_visibility = 0;
	    	if($request->has('search_visibility') && $request->input('search_visibility') != '') {
	    		$search_visibility = $request->input('search_visibility');
	    	}
			$GeneralSettings->search_visibility = $search_visibility;

	    	if( $request->hasFile('site_logo') ) {

	    		$site_logo = $request->file('site_logo');
	    		$real_path = $site_logo->getRealPath();
	            $file_orgname = $site_logo->getClientOriginalName();
	            $file_size = $site_logo->getClientSize();
	            $file_ext = strtolower($site_logo->getClientOriginalExtension());
	            $file_newname = "site_logo"."_".time().".".$file_ext;

	            $destinationPath = public_path('/uploads/site_logo');
	            $original_path = $destinationPath."/original";
	            $thumb_path = $destinationPath."/thumb";
	            
	            $img = Image::make($real_path);
	        	$img->resize(300, null, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($thumb_path.'/'.$file_newname);

	        	$site_logo->move($original_path, $file_newname);
	        	$GeneralSettings->site_logo = $file_newname;
	    	}

	    	if( $request->hasFile('site_favicon') ) {
	    		
	    		$site_favicon = $request->file('site_favicon');
	    		$real_path = $site_favicon->getRealPath();
	            $file_orgname = $site_favicon->getClientOriginalName();
	            $file_size = $site_favicon->getClientSize();
	            $file_ext = strtolower($site_favicon->getClientOriginalExtension());
	            $file_newname = "site_favicon"."_".time().".".$file_ext;

	            $destinationPath = public_path('/uploads/site_favicon');
	            $original_path = $destinationPath."/original";
	            $resize_path = $destinationPath."/24_24";
	            
	            $img = Image::make($real_path);
	        	$img->resize(24, null, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($resize_path.'/'.$file_newname);

	        	$site_favicon->move($original_path, $file_newname);
	        	$GeneralSettings->site_favicon = $file_newname;
	    	}

	    	$GeneralSettings->created_by = 0;

	    	$res = $GeneralSettings->save();
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
	    		->with('msg', 'General Settings Saved Successfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
	    		->with('msg', 'Something Went Wrong!!!');
	    	}
    	} else {
    		$updateData = array();
    		$updateData['site_name'] = trim($request->input('site_name'));
	    	$updateData['site_tagline'] = trim($request->input('site_tagline'));
	    	$updateData['site_description'] = trim($request->input('site_description'));
	    	//$updateData['display_per_page'] = trim($request->input('display_per_page'));
	    	$updateData['site_footer_text'] = trim($request->input('site_footer_text'));
	    	//$updateData['date_format'] = trim($request->input('date_format'));
	    	//$updateData['timezone_id'] = trim($request->input('timezone_id'));
	    	$updateData['site_name'] = trim($request->input('site_name'));
	    	$updateData['site_name'] = trim($request->input('site_name'));
	    	$search_visibility = 0;
	    	if($request->has('search_visibility') && $request->input('search_visibility') != '') {
	    		$search_visibility = $request->input('search_visibility');
	    	}
			$updateData['search_visibility'] = $search_visibility;

	    	if( $request->hasFile('site_logo') ) {

	    		$site_logo = $request->file('site_logo');
	    		$real_path = $site_logo->getRealPath();
	            $file_orgname = $site_logo->getClientOriginalName();
	            $file_size = $site_logo->getClientSize();
	            $file_ext = strtolower($site_logo->getClientOriginalExtension());
	            $file_newname = "site_logo"."_".time().".".$file_ext;

	            $destinationPath = public_path('/uploads/site_logo');
	            $original_path = $destinationPath."/original";
	            $thumb_path = $destinationPath."/thumb";
	            
	            $img = Image::make($real_path);
	        	$img->resize(150, 150, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($thumb_path.'/'.$file_newname);

	        	$site_logo->move($original_path, $file_newname);
	        	$updateData['site_logo'] = $file_newname;
	    	}

	    	if( $request->hasFile('site_favicon') ) {
	    		
	    		$site_favicon = $request->file('site_favicon');
	    		$real_path = $site_favicon->getRealPath();
	            $file_orgname = $site_favicon->getClientOriginalName();
	            $file_size = $site_favicon->getClientSize();
	            $file_ext = strtolower($site_favicon->getClientOriginalExtension());
	            $file_newname = "site_favicon"."_".time().".".$file_ext;

	            $destinationPath = public_path('/uploads/site_favicon');
	            $original_path = $destinationPath."/original";
	            $resize_path = $destinationPath."/24_24";
	            
	            $img = Image::make($real_path);
	        	$img->resize(24, 24, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($resize_path.'/'.$file_newname);

	        	$site_favicon->move($original_path, $file_newname);
	        	$updateData['site_favicon'] = $file_newname;
	    	}

	    	$updateData['updated_by'] = 0;
	    	$updateData['updated_at'] = date('Y-m-d H:i:s');

	    	$res = GeneralSettings::where('id', '=', '1')->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
	    		->with('msg', 'General Settings All Changes Saved Successfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
	    		->with('msg', 'Something Went Wrong!!!');
	    	}
    	}
    }

    public function socialLinksList() {
    	$dataBag = array();
    	$dataBag['parentMenu'] = "settings";
    	$dataBag['childMenu'] = "soLinks";
    	$dataBag['socialLinks'] = SocialLinks::where('status', '!=', '3')->orderBy('display_order', 'asc')->get();
    	return view('dashboard.settings.social_links_list', $dataBag);
    }

    public function addSocialLink($id = null) {
    	$dataBag = array();
    	$dataBag['parentMenu'] = "settings";
    	$dataBag['childMenu'] = "soLinks";
    	if( $id != null && $id != '' ) {
    		$dataBag['DataLink'] = SocialLinks::find($id);
    	}
    	return view('dashboard.settings.add_social_link', $dataBag);
    }

    public function saveSocialLink(Request $request) {

    	$SocialLinks = new SocialLinks;
    	$SocialLinks->name = trim($request->input('name'));
    	$SocialLinks->link = trim($request->input('link'));
    	$SocialLinks->display_order = trim($request->input('display_order'));
    	$SocialLinks->created_by = Auth::user()->id;
    
    	$SocialLinks->icon_css_class = trim($request->input('icon_css_class'));
    	$res = $SocialLinks->save();
    	if( $res ) {
    		return back()->with('msg_class', 'alert alert-success')
	    	->with('msg', 'Social Link Created Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
	    	->with('msg', 'Something Went Wrong!!!');
    	}
    }

    public function updateSocialLink(Request $request, $id) {

    	if( $id != null && $id != '' ) {

    		$updateData = array();
    		$updateData['name'] = trim($request->input('name'));
	    	$updateData['link'] = trim($request->input('link'));
	    	$updateData['display_order'] = trim($request->input('display_order'));
	    	$updateData['updated_by'] = Auth::user()->id;
	    	$updateData['updated_at'] = date('Y-m-d H:i:s');
	    	$updateData['icon_css_class'] = trim($request->input('icon_css_class'));

	    	$res = SocialLinks::where('id', '=', $id)->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
		    	->with('msg', 'Social Link Updated Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
		    	->with('msg', 'Something Went Wrong!!!');
	    	}
    	}
    }

    public function deleteSocialLink($id) {
    	if($id != '' && $id != null) {
    		$res = SocialLinks::where('id', '=', $id)->update(['status' => '3']);
    		if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
		    	->with('msg', 'Social Link Deleted Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
		    	->with('msg', 'Something Went Wrong!!!');
	    	}
    	}
    }

    public function anaLyticScripts() {
    	$dataBag = array();
    	$dataBag['parentMenu'] = "settings";
    	$dataBag['childMenu'] = "anaScripts";
    	$dataBag['anaScripts'] = AnalyticsScripts::where('status', '!=', '3')->get();
    	return view('dashboard.settings.analytics_scripts', $dataBag);
    }

    public function getAjaxLayout() {
    	$dataBag = array();
    	$dataBag['randID'] = trim(md5(microtime(TRUE)));
    	$view = view('dashboard.settings.render_analytic_layout', $dataBag)->render();
        return response()->json(['html' => $view]);
    }

    public function saveScript(Request $request) {

    	if( $request->ajax() ){

    		$script_id = trim($request->input('script_id'));
    		$ckExist = AnalyticsScripts::where('script_id', '=', $script_id)->first();
    		
    		if( empty($ckExist) ) {
	    		$AnalyticsScripts = new AnalyticsScripts;
	    		$AnalyticsScripts->script_id = $script_id;
	    		$AnalyticsScripts->script_name = trim($request->input('script_name'));
	    		$AnalyticsScripts->script_placement = trim($request->input('script_placement'));
	    		$AnalyticsScripts->script_code = htmlentities(trim($request->input('script_code')), ENT_QUOTES);
	    		$AnalyticsScripts->status = trim($request->input('status'));
	    		$AnalyticsScripts->created_by = Auth::user()->id;
	    		$res = $AnalyticsScripts->save();
    		} else {
    			$updateData = array();
    			$updateData['script_id'] = trim($request->input('script_id'));
	    		$updateData['script_name'] = trim($request->input('script_name'));
	    		$updateData['script_placement'] = trim($request->input('script_placement'));
	    		$updateData['script_code'] = htmlentities(trim($request->input('script_code')), ENT_QUOTES);
	    		$updateData['status'] = trim($request->input('status'));
	    		$updateData['updated_by'] = Auth::user()->id;
	    		$updateData['updated_at'] = date('Y-m-d H:i:s');
	    		$res = AnalyticsScripts::where('script_id', '=', $script_id)->update($updateData);
    		}

    		if( $res ) {
    			echo "ok";
    		} else {
    			echo "error";
    		}
    	}
    }

    public function deleteScript(Request $request) {

    	if( $request->ajax() ) {

    		$res = AnalyticsScripts::where('script_id', '=', trim($request->input('script_id')))->delete();
    		if( $res ) {
    			echo "ok";
    		} else {
    			echo "error";
    		}
    	}
    }

    
}
