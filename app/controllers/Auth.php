<?php


class Auth extends Controller
{
    public function __construct()
    {
      $this->service = $this->model('User');
    }

    public function register()
    {
        if( !isLoggedIn() ) {
            redirect('/');
        }

        $data = [
            'username' => '',
            'password' => '',
            'confirm_password' => '',
            'role' => '',
            'username_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'role_err' => '',
        ];

        //Check for POST
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);
            $data['role'] = trim($_POST['role']);

            // Validate username
            if ( empty($data['username']) ) {
                $data['username_err'] = 'Please inform your username';
            } else {
                // Check username
                if ( $this->service->getUserByUserName($data['username']) ) {
                    $data['username_err'] = 'Username is already in use. Choose another one!';
                }
            }

            // Validate userName
             if ( empty($data['username']) ) {
                $data['username_err'] = 'Please inform your username';
             }

             // Validate Password
             if ( empty($data['password']) ) {
                $data['password_err'] = 'Please inform your password';
             } elseif ( strlen($data['password']) < 6 ) {
                $data['password_err'] = 'Password must be at least 6 characters';
             }

             // Validate Confirm Password
             if ( empty($data['confirm_password']) ) {
                 $data['confirm_password_err'] = 'Please inform your password';
             } else if ( $data['password'] != $data['confirm_password'] ) {
                 $data['confirm_password_err'] = 'Password does not match!';
             }

             //Make sure errors are empty
             if ( empty($data['username_err']) && empty($data['role_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ) {
                 // Hash Password
                 $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                 
                $response = $this->service->register($data);
          
                if( isset($response->errorInfo) ){
                   flash('msg_error', $response->errorInfo[2], 'snackbar-error');
                   $this->view('auth/register', $data);
                } else{
                   flash('msg_success', 'You are now registered! You !');
                    $this->login();
                }
                
             }
        }
        
        $this->view('auth/register', $data);
    }

    public function login()
    {
        if( isLoggedIn() ) {
            redirect('/');
        }

        $data = [
            'username' => '',
            'password' => '',
            'username_err' => '',
            'password_err' => '',
        ];

        //Check for POST
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            // Process form
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Process form
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);

            $user = false;
            $userAuthenticated = false;
            // Validate username
            if ( empty($data['username']) ) {
                $data['username_err'] = 'Please inform your username';
            }

            if ( empty($data['password']) ) {
                $data['password_err'] = 'Please inform your password';
            }

            if(!empty($data['username'])){
                $user = $this->service->getUserByUserName($data['username']);
                if(!$user){
                    $data['username_err'] = 'No user found!';
                }
            }

            if ( !empty($data['password']) && $user != false ) {
                $userAuthenticated = $this->service->login($data['username'], $data['password']);
                if(!$userAuthenticated){
                    $data['password_err'] = 'Password are incorrect';
                }
            }

            if ( $userAuthenticated != false ) {

                $this->createUserSession($userAuthenticated);
            }
        }

        $this->view('auth/login', $data);
    }

    public function logout()
    {
        if( !isLoggedIn() ) {
            redirect('auth/login');
        }

        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('auth/login');
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_role'] = $user->role;

        redirect('');
    }
}