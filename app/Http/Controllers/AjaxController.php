<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use DB;

class AjaxController extends Controller
{
    
    public function checkSlugUrlSelf(Request $request) {

        $slug_url = trim( $request->input('slug_url') );
        $table_id = trim( $request->input('id') );
        $table = trim( $request->input('tab') );
        
        $ck = DB::table($table)->where('slug', '=', $slug_url)->where('slug', '!=', '')
        ->where('slug', '!=', NULL)->where('id', '!=', $table_id)
        ->where('status', '!=', '3')->count();
        if( $ck > 0 ) {
            return "false";
        } else {
            return "true";
        }
    }

    public function fileDelete(Request $request) {

        $table = trim( $request->input('table_name') );
        $id = trim( $request->input('id') );

        $r = DB::table( $table )->where('id', '=', $id)->delete();
        if( $r ) {
            return 'ok';
        }

        return 'error';
    }

    public function ajaxAnswerDelete(Request $request) {
        //echo 'Reached';die;

        $table = trim( $request->input('table_name') );
        $id = trim( $request->input('id') );

        $r = DB::table( $table )->where('id', '=', $id)->delete();
        if( $r ) {
            return 'ok';
        }

        return 'error';
    }

}
