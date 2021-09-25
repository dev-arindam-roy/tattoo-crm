<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommonController extends Controller
{
    
    public function activeInactive() {

    	if( isset($_GET['val']) && isset($_GET['tab']) && isset($_GET['id']) ) {
    		$val = trim( $_GET['val'] );
    		$tab = trim( $_GET['tab'] );
    		$id = trim( $_GET['id'] );
    		DB::table( $tab )->where('id', '=', $id)->update( ['status' => $val] );
    		return back()->with('msg', 'Status Changed Successfully.')->with('msg_class', 'alert alert-success');
    	}
	}
	
	public function forcedEmailVerify($uid) {
		DB::table('users')->where('id', $uid)->update(['email_verified_at' => date('Y-m-d H:i:s')]);
		return back()->with('msg', 'Email Verified Successfully.')->with('msg_class', 'alert alert-success');
	}
}
