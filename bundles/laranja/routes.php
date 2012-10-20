<?php

// Exposes all controllers with routes to it
Route::controller(Controller::detect());

// Route for Laranja_Api_Controller
//Route::controller('laranja::api');

Route::get('(:bundle)', function()
{
	return "test";
});