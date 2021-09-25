<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Session;
use Image;
use Auth;
use DB;

class FrontendController extends Controller
{
    
    public function index(Request $request)
    {
        return view('frontend.index');
    }

    public function signup(Request $request)
    {
        return view('frontend.signup');
    }

    public function createAccount(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = md5($request->input('password'));

        $ck = DB::table('users')->where('email_id', $email)->exists();
        if ($ck) {
            return redirect()->back()->with('msg', 'This email address already exist, please try with another email-id, thankyou.')
            ->with('msg_class', 'alert alert-danger');    
        }

        DB::table('users')->insert([
            'timestamp_id' => md5(microtime(true)),
            'first_name' => $name,
            'email_id' => $email,
            'password' => $password,
            'user_type' => 5
        ]);
        return redirect()->route('f.signin')->with('msg', 'Your account has been created successfully. Please signin, thankyou!.')
        ->with('msg_class', 'alert alert-success');
    }

    public function signin(Request $request)
    {
        return view('frontend.signin');
    }

    public function login(Request $request)
    {
    	$email_id = trim($request->input('email'));
    	$password = md5(trim($request->input('password')));
    	$loginUser = Users::where('email_id', '=', $email_id)
    	->where('password', '=', $password)->whereIn('user_type', [5])->where('status', '=', '1')->first(); 
        if(!empty($loginUser)) {	
    		Auth::login($loginUser);
            return redirect()->route('f.account')
            ->with('msg', 'Hi ' . $loginUser->first_name . ', Welcome to Tattoo Express')
            ->with('msg_class', 'alert alert-info');
        } else {
    		return back()->with('msg', 'Sorry! Login Information Incorrect.')
            ->with('msg_class', 'alert alert-danger');
    	}
    }

    public function account(Request $request)
    {
        return view('frontend.account');
    }

    public function uploadImage(Request $request)
    {
        if( $request->hasFile('image') ) {
            $hashId = md5(microtime(true).rand(123456, 999999));
            $img = $request->file('image');
            $real_path = $img->getRealPath();
            $file_orgname = $img->getClientOriginalName();
            $file_size = $img->getClientSize();
            $file_ext = strtolower($img->getClientOriginalExtension());
            $file_newname = "media"."_".md5(microtime(TRUE).rand(123, 999)).".".$file_ext;

            $destinationPath = public_path('/uploads/files/media_images');
            $thumb_path = $destinationPath."/thumb";
            
            $imgObj = Image::make($real_path);
            $imgObj->resize(300, NULL, function ($constraint) {
                //$constraint->aspectRatio();
            })->save($thumb_path.'/'.$file_newname);

            $img->move($destinationPath, $file_newname);
            DB::table('user_tattoo_images')->insert([
                'user_id' => Auth::user()->id,
                'hash_id' => $hashId,
                'image_org' => $file_newname,
            ]);
            
            return redirect()->route('f.set-tattoo', array('imgid' => $hashId))->with('msg', 'Your image uploaded successfully. Now please try our tattoos.')
            ->with('msg_class', 'alert alert-success');
    	}

    	return back()->with('msg', 'Sorry! Something went wrong!.')
        ->with('msg_class', 'alert alert-danger');
    }

    public function setTattoo(Request $request, $imgid)
    {
        $ck = DB::table('user_tattoo_images')->where('hash_id', $imgid)->first();
        if(empty($ck)) {
            return redirect()->route('f.account')->with('msg', 'Sorry! Something went wrong!.')
            ->with('msg_class', 'alert alert-danger');
        }
        $DataBag = [];
        $DataBag['imgx'] = $ck;
        $DataBag['tattoos'] = DB::table('image')->where('status', 1)->orderBy('id', 'desc')->paginate(25);
        return view('frontend.set-tattoo', $DataBag);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    	Session::flush();
    	return redirect()->route('f.index');
    }
}
