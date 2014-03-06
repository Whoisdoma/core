<?php

namespace Whoisdoma\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Whoisdoma\Models\WhoisServers;
use Whoisdoma\Models\ApiKey;
use Whoisdoma\Models\User;

class AdminController extends BaseController {
    
    public function get_overview()
    {
        return View::make('whoisdoma::admin.overview');
    }
    
    public function get_view_servers()
    {
        return View::make('whoisdoma::admin.servers')->with('servers', WhoisServers::all());
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
        
        $errmsg = array(
            'tld.required' => 'You must provide the tld extesion for the whois server.',
            'server.required' => 'You must provide the whois server so we can query it.',
        );

        $validator = Validator::make(Input::all(), $rules, $errmsg);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        
        $addServer = new WhoisServers(array(
            'tld' => Input::get('tld'),
            'server' => Input::get('server'),
        ));
        
        $addServer->save();
        
        return Redirect::back()->withSuccess('The whois server has been added successfully.');
        
    }
    
    
    public function get_edit_server($id)
    {
        return View::make('whoisdoma::admin.edit.server')->with('server', WhoisServers::find($id));
    }
    
    public function post_edit_server($id)
    {
        $rules = array(
            'tld' => 'required',
            'server' => 'required',
        );
        
        $errmsg = array(
            'tld.required' => 'You must provide the tld extesion for the whois server.',
            'server.required' => 'You must provide the whois server so we can query it.',
        );

        $validator = Validator::make(Input::all(), $rules, $errmsg);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        
        $server = WhoisServers::find($id);
        $server->tld = Input::get('tld');
        $server->server = Input::get('server');
        
        $server->save();
        
        return Redirect::back()->withSuccess('The whois server has been updated successfully.');   
    }
    
    public function get_delete_server($id) 
    {
        return View::make('whoisdoma::admin.delete.server')->with('server', WhoisServers::find($id));
    }
    
    public function post_delete_server($id)
    {
        $server = WhoisServers::find($id);
        $server->delete();
        
        return Redirect::back()->withSuccess('The whois server has been deleted successfully.');
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
    
    public function get_view_apikeys()
    {
        return View::make('whoisdoma::admin.apikeys')->with('apikeys', ApiKey::all());
    }
    
    public function get_delete_apikey($id)
    {
        return View::make('whoisdoma::admin.delete.apikey')->with('apikey', ApiKey::find($id));
    }
    
    public function post_delete_apikey($id)
    {
        $apikey = ApiKey::find($id);
        $apikey->delete();
        
        return Redirect::back()->withSuccess('The api key has been deleted successfully.');
    }
    
    public function get_view_users()
    {
        return View::make('whoisdoma::admin.users')->with('users', User::all());
    }
    
    public function get_edit_user($id)
    {
        return View::make('whoisdoma::admin.edit.user')->with('user', User::find($id));
    }
    
    public function post_edit_user($id)
    {
        $rules = array(
            'username' => 'required',
            'email' => 'required',
        );
        
        $errmsg = array(
            'username.required' => 'You must provide the username for the user.',
            'email.required' => 'You must provide the email for the user.',
        );

        $validator = Validator::make(Input::all(), $rules, $errmsg);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        
        $user = User::find($id);
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        
        $user->save();
        
        return Redirect::back()->withSuccess('The user has been updated successfully.');
    }
    
    public function get_edit_password($id)
    {
        return View::make('whoisdoma::admin.edit.pass')->with('user', User::find($id));
    }
    
    public function post_edit_password($id)
    {
        $rules = array(
            'newpass' => 'required',
        );
        
        $errmsg = array(
            'newpass.required' => 'You must provide a new password for the user.',
        );

        $validator = Validator::make(Input::all(), $rules, $errmsg);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        
        $user = User::find($id);
        $user->password = Hash::make(Input::get('newpass'));
        
        $user->save();
        
        return Redirect::back()->withSuccess('The users password has been updated successfully.');
    }
}