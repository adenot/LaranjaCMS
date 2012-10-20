# Laranja CMS

Laranja CMS is a RESTful Web Content Management System based on Laravel Framework. 

It has  a flexibility, extensible and pluggable architecture, you can easily use it to build everything from personal blogs to enterprise applications.
- - -
## Installing

Using php artisan from command line:

Configure your database settings in application/config/database.php

Make sure you have the migration table installed:

`php artisan migrate:install`

Then install the migrations contained on laranja bundle:

`php artisan migrate laranja`