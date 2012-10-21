<?php


// 
// USER 
//
Route::any('(:bundle)/api/user/auth', 'laranja::api.user@auth');

Route::any('(:bundle)/api/user/create', 'laranja::api.user@create');
Route::any('(:bundle)/api/user/update', 'laranja::api.user@update');









// 
// 3 Level paths:
//Route::any('(:bundle)/(:any)/(:any)/(:any)', 'laranja::(:1).(:2)@(:3)');
