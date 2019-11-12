<?php


// Submenu
Route::get('/submenu/select_submenu_byMenuId/{menu_id}', 'Api\ApiSubmenuController@selectSubmenuByMenuId')
		->name('selectSubmenuByMenuId');


// Seminars
Route::get('/seminar/participant/{slug}/edit', 'Api\ApiSeminarController@editParticipant')
		->name('api.seminar_participant_edit');






