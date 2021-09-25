<?php
Route::get('/', 'FrontendController@index')->name('f.index');
Route::get('/signup', 'FrontendController@signup')->name('f.signup');
Route::post('/signup', 'FrontendController@createAccount')->name('f.signup.post');
Route::get('/signin', 'FrontendController@signin')->name('f.signin');
Route::post('/signin', 'FrontendController@login')->name('f.signin.post');
Route::get('/account', 'FrontendController@account')->name('f.account');
Route::post('/account/upload-image', 'FrontendController@uploadImage')->name('f.uploadimage');
Route::get('/account/{imgid}/set-tattoo', 'FrontendController@setTattoo')->name('f.set-tattoo');
Route::get('/logout', 'FrontendController@logout')->name('f.logout');


Route::group(['prefix' => 'admin'], function () {

	Route::group(['middleware' => ['IfAdminNotLogIn', 'ArcsSystemLogin']], function() {
		
		Route::get('/login', 'DashboardController@login')->name('dashboard_login');
		Route::post('/login', 'DashboardController@loginAction')->name('dashboard_login_action');
		Route::get('/password-reset-link', 'DashboardController@resetLink')->name('reset_link');
		Route::post('/send-reset-link', 'DashboardController@sendLink')->name('send_link');
		Route::get('/reset-password/{token}', 'DashboardController@resetPassword')->name('reset_pwd');
		Route::post('/reset-password/{token}', 'DashboardController@resetPasswordAction')->name('post_reset_pwd');

	}); // end IfAdminNotLogIn middleware

	/********** AFTER ADMIN LOGIN PART **********/
	/********** DASHBOARD ACTION START *********/
	Route::group(['prefix' => 'dashboard',  'middleware' => ['IfAdminLogIn'] ], function () {
		
		Route::get('/', 'DashboardController@index')->name('dashboard');
		Route::get('/logout', 'DashboardController@logout')->name('logout');

		Route::get('/arindam/module', 'ArindamController@module');
		Route::post('/arindam/module', 'ArindamController@moduleSave')->name('ari.module.save');
		Route::get('/arindam/permission', 'ArindamController@permission');
		Route::post('/arindam/permission', 'ArindamController@permissionSave')->name('ari.permission.save');

		Route::group(['prefix' => 'settings'], function () {  //, 'middleware' => ['role:Super-Admin'] 

			Route::get('/', 'SettingsController@generalSettings')->name('gen_sett');
			Route::post('/save', 'SettingsController@saveGeneralSettings')->name('sv_gen_sett');
		});

		/*************** USER MANAGEMENT ******************/
		Route::group(['prefix' => 'users-management'], function () {

			Route::get('/', 'UserController@index')->name('users_list');
			Route::get('/create-user', 'UserController@createUser')->name('crte_user');
			Route::post('/save-user', 'UserController@saveUser')->name('save_user');
			Route::get('/edit-user/{user_timestamp_id}', 'UserController@editUser')->name('edit_user');
			Route::post('/update-user/{user_timestamp_id}', 'UserController@updateUser')->name('upd_user');
			Route::get('/reset-password/{user_timestamp_id}', 'UserController@resetPassword')->name('rst_pwd');
			Route::post('/update-password/{user_timestamp_id}', 'UserController@updatePassword')->name('upd_pwd');
			Route::get('/delete-user/{user_timestamp_id}', 'UserController@deleteUser')->name('del_usr');
			Route::get('/profile', 'UserController@profile')->name('usr_profile');
			Route::post('/profile', 'UserController@profileUpdate')->name('upd_profile');
			Route::get('/change-password', 'UserController@changePassword')->name('cng_pwd');
			Route::post('/change-password', 'UserController@changePasswordSave')->name('save_pwd');
			Route::post('/users-action', 'UserController@takeAction')->name('usrTKact');

			Route::get('/permissions/{user_timestamp_id}', 'UserController@userPermissions')->name('edit_user_permission');
			Route::post('/permissions/{user_timestamp_id}', 'UserController@userPermissionsUpdate')->name('update_user_permission');
		});
		
		/*************** MEDIA MANAGEMENT ******************/
		Route::group(['prefix' => 'media-library'], function() {

			Route::group(['prefix' => 'images'], function() {
				Route::get('/', 'MediaController@all_images')->name('media_all_imgs');
				Route::get('/add', 'MediaController@add')->name('media_img_add');
				Route::post('/add', 'MediaController@upload')->name('media_img_upload');
				Route::get('/details/{id}', 'MediaController@imgDetails')->name('media_img_detl');
				Route::post('/details/{id}', 'MediaController@imgDetailsUpdate')->name('media_img_Upd');
				Route::get('/delete/{id}', 'MediaController@imgDelete')->name('media_img_del');
				Route::post('/multi-delete', 'MediaController@imgMultiDelete')->name('media_img_multidel');
				Route::post('/ajax-media-img-delete', 'MediaController@ajaxImgDelete')->name('media_img_ajxDel');

				Route::get('/categories', 'MediaController@img_categories')->name('media_all_img_cats');
				Route::get('/categories/create', 'MediaController@imgCat_Create')->name('media_img_cats_crte');
				Route::post('/categories/create', 'MediaController@imgCat_Save')->name('media_img_cats_save');
				Route::get('/categories/edit/{id}', 'MediaController@imgCat_Edit')->name('media_img_cats_edt');
				Route::post('/categories/edit/{id}', 'MediaController@imgCat_Update')->name('media_img_cats_upd');
				Route::get('/categories/delete/{id}', 'MediaController@imgCat_Delete')->name('media_img_cats_del');
				Route::get('/categories/add-image/{id}', 'MediaController@img_categories_addImg')->name('media_all_img_cats_addImg');
				Route::post('/categories/add-image/{id}', 'MediaController@img_categories_upImg')->name('media_all_img_cats_upImg');

			});

		});

		/*************** AJAX ******************/
		Route::group(['prefix' => 'ajax'], function() {
			Route::post('/GalleryImageUpload', 'MediaController@ajaxGalImgUpload')->name('ajaxGalImgUpload');
			Route::post('/checkSlugUrlSelf', 'AjaxController@checkSlugUrlSelf')->name('checkSlugUrlSelf');
			Route::post('/ajax-file-delete', 'AjaxController@fileDelete')->name('ajxFileDel');
			Route::post('/ajax-media-images-upload', 'AjaxElementController@mediaImageUpload')->name('ajxMediaImgUpload');
			Route::get('/ajax-image-library', 'AjaxElementController@mediaImageLibrary')->name('ajxMediaImgLibrary');
			Route::get('/ajax-load-galleries', 'AjaxElementController@mediaLoadImageGalleries')->name('ajxMediaLdImgGals');
			Route::post('/ajax-elemodal-scodes', 'AjaxElementController@eleShortCodes')->name('ajxEleScodes');
			Route::post('/ajax-media-files-upload', 'AjaxElementController@mediaFileUpload')->name('ajxMediaFileUpload');
			Route::get('/ajax-get-media-files', 'AjaxElementController@getMediaFiles')->name('ajxMediaFileLibrary');
			Route::get('/ajax-load-file-categories', 'AjaxElementController@mediaLoadFileCategories')->name('ajxMediaLdFlCats');
			Route::post('/ajax-load-file-subcategories', 'AjaxElementController@mediaLoadFileSubCategories')->name('ajxMediaLdFlSCats');
			Route::post('/ajax-load-file-subcategories_byslug', 'AjaxElementController@mediaLoadFileSubCategoriesSlug')->name('ajxMediaLdFlSCatsSlug');
			Route::post('/ajax-load-image-subcategories', 'AjaxElementController@mediaLoadImageSubCategories')->name('ajxMediaLdImgSCats');

			Route::get('/ajax-load-image-categories', 'AjaxElementController@mediaLoadImgCategories')->name('ajxMediaLdImgCats');
			Route::post('/ajax-load-image-subcategories_byslug', 'AjaxElementController@mediaLoadImgSubCategoriesSlug')->name('ajxMediaLdImgSCatsSlug');

			Route::post('/ajax-load-video-subcategories', 'AjaxElementController@mediaLoadVidSubCategories')->name('ajxMediaLdVdSCats');

			Route::post('/ajax-media-video-add', 'AjaxElementController@mediaVideoAdd')->name('ajxMediaVidAdd');
			Route::get('/ajax-video-library', 'AjaxElementController@mediaVideoLibrary')->name('ajxMediaVidLibrary');
			
			Route::post('/ajax-answer-delete', 'AjaxController@ajaxAnswerDelete')->name('ajaxAnswerDelete');

		});

		Route::get('/active-inactive', 'CommonController@activeInactive')->name('acInac');
		Route::get('/forced-email-verify/{uid}', 'CommonController@forcedEmailVerify')->name('forceEmailVerify');
		/*** Global Image Delete ***/
		Route::get('/global-image-delete', 'DashboardController@globalImageDelete')->name('glbImgDel');

	}); //end dashboard prefix
	/********** END DASHBOARD ACTION *********/

}); //end admin prefix


