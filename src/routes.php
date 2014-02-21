<?php

$prefix = Config::get('whoisdoma::settings.url_prefix', '');

Route::group(array('prefix' => $prefix), function(){

Route::get('/index', array(
    'as' => 'index',
    'uses' => 'Whoisdoma\Controllers\MainController@showIndex'
));

Route::get('lookupdomain', array(
   'as' => 'domain_whois',
    'uses' => 'Whoisdoma\Controllers\DomainWhoisController@LookupDomain'
));

});