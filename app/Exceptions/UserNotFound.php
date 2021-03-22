<?php

namespace App\Exceptions;

use Exception;

class UserNotFound extends Exception
{
    protected $username;
    public function __construct($username){
        $this->username = $username;
    }

    public function render(){
        return response()->view('errors.user-not-found', ['username'=>$this->username], 404);
    }
}
