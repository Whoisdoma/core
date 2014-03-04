<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

