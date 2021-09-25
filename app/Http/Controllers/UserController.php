<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Users;
use App\Models\DashboardModules;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Image;
use Auth;
use DB;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use Carbon\Carbon;
use Validator;

class UserController extends Controller
{

    public function index() {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = 'userManagement';
    	$dataBag['childMenu'] = 'usersList';
        $dataBag['userList'] = Users::where('status', '!=', '3')->whereIn('user_type', [1, 2])
        ->orderBy('id', 'desc')->get();
    	return view('dashboard.users.index', $dataBag);
    }

    public function createUser() {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = 'userManagement';
        $dataBag['childMenu'] = 'createUser';
        $dataBag['dashboardModules'] = DashboardModules::with(['modulePermissions'])
        ->orderBy('order_no', 'asc')->get();
    	return view('dashboard.users.create', $dataBag);	
    }

    public function saveUser(Request $request) {

    	$request->validate([
			
            'email_id' => 'required|email|unique:users,email_id'
		],[
		
			'email_id.unique' => 'This Email-id Already Exist, Try Another.'
		]);

    	$Users = new Users;
    	$Users->timestamp_id = md5(microtime(TRUE));
    	$Users->first_name = trim($request->input('first_name'));
    	$Users->last_name = trim($request->input('last_name'));
    	$Users->email_id = trim($request->input('email_id'));
    	$Users->contact_no = trim($request->input('contact_no'));
    	$Users->password = md5(trim($request->input('password')));
        $Users->user_type = 1;
        $Users->created_by = Auth::user()->id;

    	if( $Users->save() ) {
            if($request->has('permission_ids') && !empty($request->input('permission_ids'))) {
                $Users->syncPermissions($request->input('permission_ids'));
            }
    		return back()->with('msg_class', 'alert alert-success')
    		->with('msg', 'New User Created Succesfully.');

    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong.');
    	}
    }

    public function editUser($user_timestamp_id) {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
        $dataBag['parentMenu'] = 'userManagement';
        $user = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
        $dataBag['user_data'] = $user;
    	return view('dashboard.users.edit', $dataBag);
    }

    public function updateUser(Request $request, $user_timestamp_id) {

    	$User = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	if( !empty($User) ) {

            $request->validate([
            
            'email_id' => 'required|email|unique:users,email_id,'.$User->id
            ],[
            
                'email_id.unique' => 'This Email-id Already Exist, Try Another.'
            ]);

    		$updateData = array();
    		$updateData['first_name'] = trim($request->input('first_name'));
    		$updateData['last_name'] = trim($request->input('last_name'));
    		$updateData['email_id'] = trim($request->input('email_id'));
    		$updateData['contact_no'] = trim($request->input('contact_no'));
    		$updateData['sex'] = trim($request->input('sex'));
    		$updateData['address'] = trim($request->input('address'));
    		$updateData['status'] = trim($request->input('status'));
    		$updateData['updated_by'] = Auth::user()->id;
    		$updateData['updated_at'] = date('Y-m-d H:i:s');
    		if( $request->hasFile('image') ) {

	    		$image = $request->file('image');
	    		$real_path = $image->getRealPath();
	            $file_orgname = $image->getClientOriginalName();
	            $file_size = $image->getClientSize();
	            $file_ext = strtolower($image->getClientOriginalExtension());
	            $file_newname = "user"."_".time().".".$file_ext;

	            $destinationPath = public_path('/uploads/user_images');
	            $original_path = $destinationPath."/original";
	            $thumb_path = $destinationPath."/thumb";
	            
	            $img = Image::make($real_path);
	        	$img->resize(150, 150, function ($constraint) {
			    	$constraint->aspectRatio();
				})->save($thumb_path.'/'.$file_newname);

	        	$image->move($original_path, $file_newname);
	        	$updateData['image'] = $file_newname;
	    	}
	    	$res = Users::where('timestamp_id', '=', $user_timestamp_id)->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
    			->with('msg', 'User Updated Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
    			->with('msg', 'Something Went Wrong.');
	    	}
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong. User Missmatch');
    	}
    }

    public function resetPassword( $user_timestamp_id ) {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = 'userManagement';
    	$dataBag['user_data'] = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	return view('dashboard.users.reset_password', $dataBag);
    }

    public function updatePassword(Request $request, $user_timestamp_id) {

    	$ck = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	if( !empty($ck) ) {
    		$updateData = array();
    		$updateData['password'] = md5(trim($request->input('password')));
    		$res = Users::where('timestamp_id', '=', $user_timestamp_id)->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
    			->with('msg', 'User Password Updated Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
    			->with('msg', 'Something Went Wrong.');
	    	}
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong. User Missmatch');
    	}
    }

    public function deleteUser( $user_timestamp_id ) {

        $res = Users::where('timestamp_id', '=', $user_timestamp_id)->update(['status' => '3']);
        $user = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
        DB::table('model_has_permissions')->where('model_id', $user->id)->delete();
    	if( $res ) {
    		return back()->with('msg_class', 'alert alert-success')
			->with('msg', 'User Deleted Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
			->with('msg', 'Something Went Wrong.');
    	}
    }

    public function profile() {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
        $dataBag['parentMenu'] = 'settings';
        $dataBag['childMenu'] = 'profile';
        return view('dashboard.users.profile', $dataBag);
    }

    public function profileUpdate(Request $request) {

        $user_id = Auth::user()->id;
        $request->validate([
            
        'email_id' => 'required|email|unique:users,email_id,'.$user_id
        ],[
        
            'email_id.unique' => 'This Email-id Already Exist, Try Another.'
        ]);

        $updateData = array();
        $updateData['first_name'] = trim($request->input('first_name'));
        $updateData['last_name'] = trim($request->input('last_name'));
        $updateData['email_id'] = trim($request->input('email_id'));
        $updateData['contact_no'] = trim($request->input('contact_no'));
        $updateData['sex'] = trim($request->input('sex'));
        $updateData['address'] = trim($request->input('address'));
        $updateData['updated_by'] = $user_id;
        $updateData['updated_at'] = date('Y-m-d H:i:s');
        if( $request->hasFile('image') ) {

            $image = $request->file('image');
            $real_path = $image->getRealPath();
            $file_orgname = $image->getClientOriginalName();
            $file_size = $image->getClientSize();
            $file_ext = strtolower($image->getClientOriginalExtension());
            $file_newname = "user"."_".time().".".$file_ext;

            $destinationPath = public_path('/uploads/user_images');
            $original_path = $destinationPath."/original";
            $thumb_path = $destinationPath."/thumb";
            
            $img = Image::make($real_path);
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($thumb_path.'/'.$file_newname);

            $image->move($original_path, $file_newname);
            $updateData['image'] = $file_newname;
        }
        $res = Users::where('id', '=', $user_id)->update($updateData);
        if( $res ) {
            return back()->with('msg_class', 'alert alert-success')
            ->with('msg', 'Profile Updated Succesfully.');
        } else {
            return back()->with('msg_class', 'alert alert-danger')
            ->with('msg', 'Something Went Wrong.');
        }
    }

    public function changePassword() {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
        $dataBag['parentMenu'] = 'settings';
        $dataBag['childMenu'] = 'cngPwd';
        return view('dashboard.users.change_password', $dataBag);
    }

    public function changePasswordSave(Request $request) {

        $current_password = md5(trim($request->input('current_password')));
        $new_password = md5(trim($request->input('new_password')));
        $ck = Users::where('id', '=', Auth::user()->id)
        ->where('password', '=', $current_password)->first();
        if( !empty($ck) ) {
            $res = Users::where('id', '=', Auth::user()->id)->update(['password' => $new_password]);
            if( $res ) {
                return back()->with('msg_class', 'alert alert-success')
                ->with('msg', 'Password Changed Succesfully.');
            } else {
                return back()->with('msg_class', 'alert alert-danger')
                ->with('msg', 'Something Went Wrong.');
            }
        } else {
            return back()->with('msg_class', 'alert alert-danger')
            ->with('msg', 'Current Password Not Match.');
        }
    }

    public function userPermissions($user_timestamp_id) {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
        $dataBag['parentMenu'] = 'userManagement';
        $dataBag['dashboardModules'] = DashboardModules::with(['modulePermissions'])
        ->orderBy('order_no', 'asc')->get();
        $user = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
        $dataBag['user_data'] = $user;
        $dataBag['user_permissions'] = $user->getAllPermissions()->pluck('id')->toArray();
    	return view('dashboard.users.user_permissions', $dataBag);
    }

    public function userPermissionsUpdate(Request $request, $user_timestamp_id)
    {
        $User = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	if( !empty($User) ) {
            //$currentPermissions = DB::table('model_has_permissions')->where('model_id', $User->id)->delete();
            if($request->has('permission_ids') && !empty($request->input('permission_ids'))) {
                $User->syncPermissions($request->input('permission_ids'));
                return back()->with('msg_class', 'alert alert-success')
                ->with('msg', 'Permissions updated successfully.');
            }
        }
        return back()->with('msg_class', 'alert alert-danger')
        ->with('msg', 'Something went wrong.');
    }

    public function takeAction(Request $request) {
        $msg = '';
        if( $request->has('action_btn') && $request->has('user_ids') ) {
            $actBtnValue = trim( $request->input('action_btn') );
            $idsArr = $request->input('user_ids');

            switch ( $actBtnValue ) {
                
                case 'activate':
                    foreach($idsArr as $id) {
                        $user = Users::find($id);
                        $user->status = '1';
                        $user->save();
                    }
                    $msg = 'Users Activated Succesfully.';
                    break;

                case 'deactivate':
                    foreach($idsArr as $id) {
                        $user = Users::find($id);
                        $user->status = '2';
                        $user->save();
                    }
                    $msg = 'Users Deactivated Succesfully.';
                    break;

                case 'delete_user':
                    foreach($idsArr as $id) {
                        $user = Users::find($id);
                        $user->status = '3';
                        $user->save();
                        DB::table('model_has_permissions')->where('model_id', $id)->delete();
                    }
                    $msg = 'Users Deleted Succesfully.';
                    break;
            }
            return back()->with('msg', $msg)->with('msg_class', 'alert alert-success');
        }
        return back();
    }

    //Vendor

    public function vendorList()
    {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'vendorList';
        $dataBag['userList'] = Users::where('status', '!=', '3')->where('user_type', 5)
        ->orderBy('id', 'desc')->get();
    	return view('dashboard.users.vendor_index', $dataBag);
    }

    public function vendorCreate()
    {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'vendorList';
    	return view('dashboard.users.vendor_create', $dataBag);
    }

    public function vendorSave(Request $request) {

    	$Users = new Users;
    	$Users->timestamp_id = md5(microtime(TRUE));
    	$Users->first_name = trim($request->input('first_name'));
    	$Users->last_name = trim($request->input('last_name'));
    	$Users->email_id = trim($request->input('email_id')) ? trim($request->input('email_id')) : str_random(32);
    	$Users->contact_no = trim($request->input('contact_no'));
    	$Users->password = str_random(32);
        $Users->user_type = 5;
        $Users->created_by = Auth::user()->id;

    	if( $Users->save() ) {
            return back()->with('msg_class', 'alert alert-success')
    		->with('msg', 'New Vendor Created Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong.');
    	}
    }

    public function vendorEdit($user_timestamp_id) {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'vendorList';
        $user = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
        $dataBag['user_data'] = $user;
    	return view('dashboard.users.vendor_create', $dataBag);
    }

    public function vendorUpdate(Request $request, $user_timestamp_id) {

    	$User = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	if( !empty($User) ) {
    		$updateData = array();
    		$updateData['first_name'] = trim($request->input('first_name'));
            $updateData['last_name'] = trim($request->input('last_name')); 
    		$updateData['email_id'] = trim($request->input('email_id')) ? trim($request->input('email_id')) : str_random(32);
    		$updateData['contact_no'] = trim($request->input('contact_no'));
    		$updateData['updated_by'] = Auth::user()->id;
    		$updateData['updated_at'] = date('Y-m-d H:i:s');
	    	$res = Users::where('timestamp_id', '=', $user_timestamp_id)->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
    			->with('msg', 'Vendor Updated Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
    			->with('msg', 'Something Went Wrong.');
	    	}
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong. User Missmatch');
    	}
    }

    public function vendorDelete($user_timestamp_id) {

        $res = Users::where('timestamp_id', '=', $user_timestamp_id)->update(['status' => '3']);
    	if( $res ) {
    		return back()->with('msg_class', 'alert alert-success')
			->with('msg', 'Vendor Deleted Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
			->with('msg', 'Something Went Wrong.');
    	}
    }

    //Customer

    public function customerList()
    {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'customerList';
        $dataBag['userList'] = Users::where('status', '!=', '3')->where('user_type', 6)
        ->orderBy('id', 'desc')->get();
    	return view('dashboard.users.customer_index', $dataBag);
    }

    public function customerCreate()
    {
        $dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'customerList';
    	return view('dashboard.users.customer_create', $dataBag);
    }

    public function customerSave(Request $request) {

    	$Users = new Users;
    	$Users->timestamp_id = md5(microtime(TRUE));
    	$Users->first_name = trim($request->input('first_name'));
    	$Users->last_name = trim($request->input('last_name'));
    	$Users->email_id = trim($request->input('email_id')) ? trim($request->input('email_id')) : str_random(32);
    	$Users->contact_no = trim($request->input('contact_no'));
    	$Users->password = str_random(32);
        $Users->user_type = 6;
        $Users->created_by = Auth::user()->id;

    	if( $Users->save() ) {
            return back()->with('msg_class', 'alert alert-success')
    		->with('msg', 'New Customer Created Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong.');
    	}
    }

    public function customerEdit($user_timestamp_id) {
    	$dataBag = array();
        $dataBag['GparentMenu'] = 'management';
    	$dataBag['parentMenu'] = '';
    	$dataBag['childMenu'] = 'customerList';
        $user = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
        $dataBag['user_data'] = $user;
    	return view('dashboard.users.customer_create', $dataBag);
    }

    public function customerUpdate(Request $request, $user_timestamp_id) {

    	$User = Users::where('timestamp_id', '=', $user_timestamp_id)->first();
    	if( !empty($User) ) {

    		$updateData = array();
    		$updateData['first_name'] = trim($request->input('first_name'));
    		$updateData['last_name'] = trim($request->input('last_name'));
    		$updateData['email_id'] = trim($request->input('email_id')) ? trim($request->input('email_id')) : str_random(32);
    		$updateData['contact_no'] = trim($request->input('contact_no'));
    		$updateData['updated_by'] = Auth::user()->id;
    		$updateData['updated_at'] = date('Y-m-d H:i:s');
	    	$res = Users::where('timestamp_id', '=', $user_timestamp_id)->update($updateData);
	    	if( $res ) {
	    		return back()->with('msg_class', 'alert alert-success')
    			->with('msg', 'Customer Updated Succesfully.');
	    	} else {
	    		return back()->with('msg_class', 'alert alert-danger')
    			->with('msg', 'Something Went Wrong.');
	    	}
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
    		->with('msg', 'Something Went Wrong. User Missmatch');
    	}
    }

    public function customerDelete($user_timestamp_id) {

        $res = Users::where('timestamp_id', '=', $user_timestamp_id)->update(['status' => '3']);
    	if( $res ) {
    		return back()->with('msg_class', 'alert alert-success')
			->with('msg', 'Customer Deleted Succesfully.');
    	} else {
    		return back()->with('msg_class', 'alert alert-danger')
			->with('msg', 'Something Went Wrong.');
    	}
    }

}
