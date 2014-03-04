<?php

$prefix = Config::get('whoisdoma::settings.url_prefix', '');

Route::group(array('before' => 'whoisdoma_is_installed'), function(){

Route::get('/', array(
    'as' => 'index',
    'uses' => 'Whoisdoma\Controllers\MainController@showIndex'
));


Route::get('login', array(
    'as' => 'login',
    'uses' => 'Whoisdoma\Controllers\AuthController@get_login'
));

Route::post('login', 'Whoisdoma\Controllers\AuthController@post_login');

Route::get('logout', array(
    'as' => 'logout',
    'uses' => 'Whoisdoma\Controllers\AuthController@get_logout'
));

});



Route::group(array('prefix' => 'admin', 'before' => array('auth', 'whoisdoma_is_installed')), function() {
   
Route::get('overview', array(
   'as' => 'admin_overview',
   'uses' => 'Whoisdoma\Controllers\AdminController@get_overview'
));

Route::get('create/server', array(
    'as' => 'admin_add_server',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_add_server'
));

Route::post('create/server', 'Whoisdoma\Controllers\AdminController@post_add_server');
    
Route::get('create/apikey', array(
    'as' => 'admin_add_apikey',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_create_apikey'
));

Route::post('create/apikey', 'Whoisdoma\Controllers\AdminController@post_create_apikey');

});

Route::group(array('prefix' => 'v1/domain', 'before' => 'whoisdoma_is_installed'), function() {
 
    Route::get('lookup', array(
    'as' => 'domain_whois',
    'uses' => 'Whoisdoma\Controllers\DomainWhoisController@LookupDomain'
    ));
    
});
