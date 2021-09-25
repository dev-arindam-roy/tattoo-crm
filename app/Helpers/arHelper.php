<?php

function getGeneralSettings() {
	$arr = DB::table('general_settings')->where('id', '=', '1')->first();
	return $arr;
}

function sizeFilter( $bytes ) {
	if( $bytes != '' && $bytes != null ) {
    $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $label[$i] );
	} else {
		return "0";
	}
}

function fileInfo( $fileId ) {
	$dataArr = array();
	if( $fileId != null && $fileId != '' ) {
		$dataArr = DB::table('files_master')->where('id', '=', $fileId)->first();
	}
	return $dataArr;
}

function imageInfo( $imgId ) {
	$dataArr = array();
	if( $imgId != null && $imgId != '' ) {
		$dataArr = DB::table('image')->where('id', '=', $imgId)->first();
	}
	return $dataArr;
}

function getImageById($imgid) {
	$data = array();
	if($imgid != '' && $imgid != '0') {
		$data = DB::table('image')->where('id', '=', $imgid)->first();
	}

	return $data;
}

function checkRegistrationPaymentStatus($userID) {
	$rtn = 'In-Progress';
	if($userID != '') {
		$ck = DB::table('users')->where('id', $userID)->first();
		if(!empty($ck)) {
			if($ck->payment_type == 1) {
				$data = DB::table('user_payment_info')->where('user_id', $userID)->first();
				if(!empty($data)) {
					if ($data->payment_status == 0) {
						$rtn = 'In-Progress';
					} elseif ($data->payment_status == 1) {
						$rtn = 'Completed';
					} elseif ($data->payment_status == 2) {
						$rtn = 'Pending';
					} elseif ($data->payment_status == 3) {
						$rtn = 'Failed';
					} else {
						$rtn = 'In-Progress';
					}
				}
			}
			if($ck->payment_type == 2) {
				$data = DB::table('user_payment_info')->where('useby_user_id', $userID)->first();
				if(!empty($data)) {
					$rtn = 'Voucher Applied <br/>('. $data->voucher_code .')';
				}
			}	
		}
	}
	return $rtn;
}

function getContentImage($content_id) {
	$rtnData = array();
	if($content_id != '' && $content_id != 0) {
		$imageMap = DB::table('content_images_map')->where('content_id', $content_id)->get();
		if(!empty($imageMap)) {
			foreach($imageMap as $img) {
				$image = DB::table('image')->where('id', $img->image_id)->first();
				if(!empty($image)) {
					$arr = array();
					$arr['image_name'] = $image->image;
					$arr['title'] = $img->title;
					$arr['alt_tag'] = $img->alt_tag;
					array_push($rtnData, $arr);
				}
			}
		}
	}
	return $rtnData;
}

function addOnManagement() {
	$rtnData = array();
	$data = DB::table('content_type')->where('status', '!=', '3')->where('is_management', 1)
	->orderBy('id', 'asc')->get();
	if(!empty($data)) {
		foreach($data as $v) {
			$arr = array();
			$arr['route_text'] = str_limit($v->name, '16', '..'); 
			$arr['route'] = route('mngLists', array('type' => str_slug($v->name), 'type_id' =>$v->id)) . '?isManagement=true';
			array_push($rtnData, $arr);
		}
	}
	return $rtnData;
}
?>