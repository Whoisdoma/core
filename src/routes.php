<?php


Route::get('api/v1/index', array(
    'as' => 'index',
    'uses' => 'Whoisdoma\Controllers\MainController@showIndex'
));

