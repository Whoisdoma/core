<?php

namespace Whoisdoma\Models;

use Illuminate\Auth\UserInterface;

class User extends Base implements UserInterface 
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'users';
    
    protected $fillable = array(
        'email',
        'password',
    );
    
    public function getAuthIdentifier()
    {
	return $this->getKey();
    }

    public function getAuthPassword()
    {
	return $this->password;
    }
}


