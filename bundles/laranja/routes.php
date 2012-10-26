<?php


// 
// USER 
//
Route::any('(:bundle)/api/user/auth', 'laranja::api.user@auth');

Route::any('(:bundle)/api/user/create', 'laranja::api.user@create');
Route::any('(:bundle)/api/user/update', 'laranja::api.user@update');

// 
// CONTENT
//
Route::post('(:bundle)/api/content/create', 'laranja::api.content@create');
Route::post('(:bundle)/api/content/update', 'laranja::api.content@update');

// get content
Route::get('(:bundle)/get/(:any)', 'laranja::api.content@open');





// 
// 3 Level paths:
//Route::any('(:bundle)/(:any)/(:any)/(:any)', 'laranja::(:1).(:2)@(:3)');
