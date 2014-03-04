<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Whoisdoma\Models\WhoisServers;
use Whoisdoma\Models\ApiKey;

class AdminController extends BaseController {
    
    public function get_overview()
    {
        return View::make('whoisdoma::admin.overview');
    }
    
    public function get_add_server()
    {
        return View::make('whoisdoma::admin.create.server');
    }
    
    public function post_add_server()
    {
        $rules = array(
            'tld' => 'required',
            'server' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        
        $addServer = new WhoisServers(array(
            'tld' => Input::get('tld'),
            'server' => Input::get('server'),
        ));
        
        $addServer->save();
        
        return Redirect::to('admin/overview');
        
    }
    
    public function get_create_apikey()
    {
        return View::make('whoisdoma::admin.create.apikey');
    }
    
    public function post_create_apikey()
    {
      $key = Str::random(25);  
      
      $create_apikey = new ApiKey(array(
          'api_key' => $key,
      ));
      
      $create_apikey->save();
      
      return Redirect::back()->with('key', 'Your new api key is'. $key);
    }
    
}

