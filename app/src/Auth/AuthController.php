<?php

namespace Phpmvc\Auth;
use Anax\Validate\CValidate;
use Anax\HTMLForm as CForm;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class AuthController  implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     * @return void
     */
    public function initialize(){
        $this->auth = new \Anax\Auth\Auth();
        $this->auth->setDI($this->di);
    }

    public function loginAction(){
        $this->auth->login();
        echo "kalle";

    }
    public function logoutAction(){

    }
    public function isLoggedIn(){

    }
}
