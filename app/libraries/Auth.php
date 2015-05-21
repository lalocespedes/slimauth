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

        //roles
    }

    public function checkLogin($email, $password) {

        //buscar usuario en la base datos

        $q = User::where('username', '=', $email)->where('password', '=', $password)->first();

        if(count($q) == 1) {

            $user = array("user"=>$email, "name"=>$q->name, "role"=>$q->rol);
            
            $_SESSION['user'] = $user;

            return true;
        }

        return false;
    }
    
}
