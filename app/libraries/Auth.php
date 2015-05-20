<?php

class Auth extends \Slim\Middleware
{
    private $response = array();

    public function __construct()
    {
        
    }

    public function call()
    {
        // Get reference to application
        $app = $this->app;

        $email = trim($app->request()->post('email'));
        $password = $app->request()->post('password');

        if($this->checkLogin($email, $password)) {
            
            $this->app->response->redirect('/');

        } else {

            $app->render('sessions/login.php');

        }
    }

    public function checkLogin($email, $password) {

        if($email == 'lalo') {

            $_SESSION['user'] = $email;
            return true;
        }

        return false;
    }
    
}
