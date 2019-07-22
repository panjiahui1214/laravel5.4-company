<?php

define('LARAVEL_START', microtime(true));

/*
 * 增加定义表名称常量
 * add by pjh 20180404
 */
define('TABLE_ADMINS', 'admins');
define('TABLE_USERS', 'users');

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so we do not have to manually load any of
| our application's PHP classes. It just feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';
