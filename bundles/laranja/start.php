<?php

Auth::extend('laranja_auth', function()
{
	return new Laranja_Auth;
});

/*
|--------------------------------------------------------------------------
| Auto-Loader Mappings
|--------------------------------------------------------------------------
|
| Laravel uses a simple array of class to path mappings to drive the class
| auto-loader. This simple approach helps avoid the performance problems
| of searching through directories by convention.
|
| Registering a mapping couldn't be easier. Just pass an array of class
| to path maps into the "map" function of Autoloader. Then, when you
| want to use that class, just use it. It's simple!
|
*/

Autoloader::map(array(
	/* Laravel Core Extensions */
	'Laranja_Auth' => path('bundle') . 'laranja/extensions/auth.php',
	
	/* Controllers */
	'Laranja_Api_Base_Controller' => path('bundle') . 'laranja/controllers/api/base.php',
	
	/* Models */
	'LaranjaUser' => path('bundle') . 'laranja/models/user.php',
	'LaranjaStorage' => path('bundle') . 'laranja/models/storage.php',
	'LaranjaContent' => path('bundle') . 'laranja/models/content.php',
));

/*
|--------------------------------------------------------------------------
| Auto-Loader Directories
|--------------------------------------------------------------------------
|
| The Laravel auto-loader can search directories for files using the PSR-0
| naming convention. This convention basically organizes classes by using
| the class namespace to indicate the directory structure.
|
*/

Autoloader::directories(array(

));