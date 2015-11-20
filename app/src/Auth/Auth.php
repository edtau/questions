<?php
namespace Anax\Auth;

/**
 * Model for Users.
 *
 */
class Auth  extends  \Anax\Database\Database
{
    public function loggedIn(){
        return true;
    }
    public function login(){
        echo "kenta";
    }
    public function logout(){

    }
}
