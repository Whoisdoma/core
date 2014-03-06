<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController {
    
    public function get_login()
    {
        return View::make('whoisdoma::auth.login');
    }
    
    public function post_login()
    {
        $user_info = array(
            'username' => Input::get('username'),
            'password' => Input::get('pass'),
        );
        
        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );
        
        $errmsgs = array(
            'username.required' => 'You must provide your administrator username.',
            'password.required' => 'You must provide your password',
        );
        
       $validator = Validator::make($user_info, $rules, $errmsgs);
       
       if ($validator->fails())
       {
           return Redirect::back()->withErrors($validator);
       }
                
        
        if (Auth::attempt($user_info))
        {
            return Redirect::route('admin_overview');
        }
    }
    
    public function get_logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }
    
}

