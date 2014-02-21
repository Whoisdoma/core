<?php

/* 
 * @package Whoisdoma Core
 * 
 */

namespace Whoisdoma;

use Illuminate\Support\Facades\Facade;

class Core extends Facade
{

    protected static function getFacadeAccessor()
	{
		return static::$app;
	}

	public static function isInstalled()
	{
		$app = static::$app;
		return file_exists($app['path'].'/config/whoisdoma.php');
	}

	public static function version()
	{
		return '1.0.0-alpha1';
	}
    
}