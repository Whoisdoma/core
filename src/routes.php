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



Route::group(array('before' => array('auth', 'whoisdoma_is_installed')), function() {
   
Route::get('admin', array(
   'as' => 'admin_overview',
   'uses' => 'Whoisdoma\Controllers\AdminController@get_overview'
));

Route::get('admin/servers', array(
    'as' => 'admin_view_servers',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_view_servers'
));

Route::get('admin/servers/new', array(
    'as' => 'admin_add_server',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_add_server'
));

Route::post('admin/servers/new', 'Whoisdoma\Controllers\AdminController@post_add_server');

Route::get('admin/servers/edit/{id}', array(
    'as' => 'admin_edit_server',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_edit_server'
));

Route::post('admin/servers/edit/{id}', 'Whoisdoma\Controllers\AdminController@post_edit_server');

Route::get('admin/servers/delete/{id}', array(
    'as' => 'admin_delete_server',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_delete_server'
));

Route::post('admin/servers/delete/{id}', 'Whoisdoma\Controllers\AdminController@post_delete_server');


Route::get('admin/apikeys', array(
    'as' => 'admin_view_apikeys',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_view_apikeys'
));

Route::get('admin/apikeys/new', array(
    'as' => 'admin_add_apikey',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_create_apikey'
));

Route::post('admin/apikeys/new', 'Whoisdoma\Controllers\AdminController@post_create_apikey');

Route::get('admin/apikeys/delete/{id}', array(
    'as' => 'admin_delete_apikey',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_delete_apikey'
));

Route::post('admin/apikeys/delete/{id}', 'Whoisdoma\Controllers\AdminController@post_delete_apikey');

Route::get('admin/users', array(
    'as' => 'admin_view_users',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_view_users'
));

Route::get('admin/users/edit/{id}', array(
    'as' => 'admin_edit_user',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_edit_user'
));

Route::post('admin/users/edit/{id}', 'Whoisdoma\Controllers\AdminController@post_edit_user');

Route::get('admin/users/edit/password/{id}', array(
   'as' => 'admin_edit_password',
    'uses' => 'Whoisdoma\Controllers\AdminController@get_edit_password'
));

Route::post('admin/users/edit/password/{id}', 'Whoisdoma\Controllers\AdminController@post_edit_password');

});

Route::group(array('prefix' => 'v1/domain', 'before' => 'whoisdoma_is_installed'), function() {
 
    Route::get('lookup', array(
    'as' => 'domain_whois',
    'uses' => 'Whoisdoma\Controllers\DomainWhoisController@LookupDomain'
    ));
    
});
