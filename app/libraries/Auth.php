<?php

class Auth extends \Slim\Middleware
{
    private $response = array();

    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $tokenAuth;

    public function __construct()
    {
        
    }

    public function call()
    {
        // Get reference to application
        $app = $this->app;

        $this->email = trim($app->request()->post('email'));
        $this->password = $app->request()->post('password');
        $this->tokenAuth = $app->request->headers->get('Authorization');

        if(!isset($_SESSION['user'])) {

            if($this->authenticate()) {
                
                $app->redirect('/');
                
            } else {

                $app->render('sessions/login.php');

                if ($_POST) {
                    
                    echo "Usuario y/o password incorrecto";
                    $this->deny_access();
                }

            }

        } else {

             $this->next->call();
        }

        //roles
    }

    public function authenticate() {

        $user = User::where('username', '=', $this->email)->where('password', '=', $this->password)->first();

        //si no hay usuario

        if(count($user) == 1) {

            //generar session
            $user = array("user"=>$this->email, "name"=>$user->name, "role"=>$user->rol);
            
            $_SESSION['user'] = $user;

            //generar token
            //$this->token_generate();

            //echo "Logueado correctaemnte";

            return true;
        }

        return false;
    }

    /**
     * Deny Access
     *
     */
    public function deny_access() {
        $res = $this->app->response();
        $res->status(401);
    }

    public function token_generate()
    {
        //$arrRtn['token'] = bin2hex(openssl_random_pseudo_bytes(16)); //generate a random token

        //$tokenExpiration = date('Y-m-d H:i:s', strtotime('+1 hour'));//the expiration date will be in one hour from the current moment

        //guardar token y tokenexpiration en la base de datos
    }
    
}
