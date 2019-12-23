<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {


	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');


	/** USER **/   
	Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');


	/** MENU **/
	Route::resource('menu', 'MenuController');


	/** SEMINARS **/
	Route::get('/seminar/view_attendance_sheet/{slug}', 'SeminarController@viewAttendanceSheet')->name('seminar.view_attendance_sheet');
	Route::get('/seminar/view_seminar/{slug}', 'SeminarController@viewSeminar')->name('seminar.view_seminar_details');

	Route::resource('seminar', 'SeminarController');
	

	/** SEMINAR PARTICIPANTS **/
	Route::get('/seminar/participant/{slug}', 'SeminarController@participant')->name('seminar.participant');
	Route::post('/seminar/participant/store/{slug}', 'SeminarController@participantStore')->name('seminar.participant_store');
	Route::put('/seminar/participant/update/{slug}', 'SeminarController@participantUpdate')->name('seminar.participant_update');
	Route::delete('/seminar/participant/destroy/{slug}', 'SeminarController@participantDestroy')->name('seminar.participant_destroy');
	Route::get('/seminar/participant/{slug}/edit', 'SeminarController@participantEdit')->name('seminar.participant_edit');


	/** SEMINAR SPEAKERS **/
	Route::get('/seminar/speaker/{slug}', 'SeminarController@speaker')->name('seminar.speaker');
	Route::post('/seminar/speaker/store/{slug}', 'SeminarController@speakerStore')->name('seminar.speaker_store');
	Route::put('/seminar/speaker/update/{slug}/{spkr_slug}', 'SeminarController@speakerUpdate')->name('seminar.speaker_update');
	Route::delete('/seminar/speaker/destroy/{slug}', 'SeminarController@speakerDestroy')->name('seminar.speaker_destroy');


	/** BLOCK FARMING **/
	Route::resource('block_farm','BlockFarmController');

});



/** Testing **/
Route::get('/dashboard/test', function(){

	return dd(Illuminate\Support\Str::random(16));
	
	//dd(number_format(null));

	//dd(9>=9);

});

