<?php
    
class Users extends Controller
{
    public function __construct()
    {
        if(!isLoggedIn() ){
            redirect('auth/login');
        }
    
        $this->service = $this->model('User');
        $this->superUser = SUPER_USER;
        $this->normalUser = NORMAL_USER;
        $this->allUser = array_merge(SUPER_USER, NORMAL_USER);
    }
    
    public function index()
    {
        $data = $this->service->getUsers();
        return $this->view('users/index', $data);
    }

    public function changePassword()
    {
        //Check for POST
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            // Process form
            $data = [
                'username' => $_SESSION['user_name'],
                'password_old' => trim($_POST['password_old']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'password_old_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Password Old
            if ( empty($data['password_old']) ) {
                $data['password_old_err'] = 'Please inform your old password';
            } elseif ( strlen($data['password_old']) < 6 ) {
                $data['password_old_err'] = 'Password old must be at least 6 characters';
            } else if (! $this->service->checkPassword($_SESSION['user_name'], $data['password_old']) ) {
                $data['password_old_err'] = 'Your old password is wrong!';
            }
            
                // Validate Password
            if ( empty($data['password']) ) {
                $data['password_err'] = 'Please inform your password';
            } elseif ( strlen($data['password']) < 6 ) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
        
            // Validate Confirm Password
            if ( empty($data['confirm_password']) ) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else if ( $data['password'] != $data['confirm_password'] ) {
                $data['confirm_password_err'] = 'Password does not match!';
            }
        
            //Make sure errors are empty
            if ( empty($data['password_old_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                $response = $this->service->updatePassword($data);
                if( isset($response->errorInfo) ){
                  flash('msg_error', $response->errorInfo[2], 'snackbar-error');
                } else{
                  flash('msg_success', 'Password updated');
                }

                //$this->view('users/changepassword', $data);
            //} else{
                // Load view with errors
            }
            $this->view('users/changepassword',$data);
        } else {
            // Init data
            $data = [
                'password_old' => '',
                'password' => '',
                'confirm_password' => '',
                'password_old_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
        
            // Load view
            $this->view('users/changepassword', $data);
        }
    }

    public function add()
    {
        $opt = $this->allUser;

        $data = [
            'username' => '',
            'role' => '',
            'password' => '',
            'confirm_password' => '',
            'username_err' => '',
            'role_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];

        //Check for POST
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
            // Process form
            $data['username'] = trim(strtolower($_POST['username']));
            $data['role'] = trim(strtolower($_POST['role']));
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);
        
            // Validate role
            if ( empty($data['role']) ) {
                $data['role_err'] = 'Please inform the role user';
            }
        
            // Validate userName
            if ( empty($data['username']) ) {
                $data['username_err'] = 'Please inform the username of user';
            }

            $user = $this->service->getUserByUserName($data['username']);

            if($user){
                $data['username_err'] = 'Username exists';
            }
        
            // Validate Password
            if ( empty($data['password']) ) {
                $data['password_err'] = 'Please inform the password';
            } elseif ( strlen($data['password']) < 6 ) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
        
            // Validate Confirm Password
            if ( empty($data['confirm_password']) ) {
                $data['confirm_password_err'] = 'Please inform the password';
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
                  $this->view('users/add', $data, $opt);
                } else{
                  flash('msg_success', 'New user created');
                  redirect('users');
                }
            }
        }
        
        $this->view('users/add', $data, $opt);
    }

    public function edit($id)
    {
        $opt = $this->allUser;
        // Get existing post from model
        $user = $this->service->getUserById($id);

        $data = [
            'id' => $id,
            'username' => $user->username,
            'role' => $user->role,
            'username_err' => '',
            'role_err' => ''
        ];

        if($_SERVER['REQUEST_METHOD']=='POST'){
            // Sanitize POST Array
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data['id'] = $id;
            $data['username'] = trim(strtolower($_POST['username']));
            $data['role'] = trim(strtolower($_POST['role']));
            $data['updated_at'] = date("Y-m-d H:i:s");

          // Validate
            if( empty($data['username']) ){
                $data['username_err'] = 'Please enter the username';
            }

            $user = $this->service->getUserByUserName($data['username']);
            if($user && $user->id != $id){
              $data['username_err'] = 'Username has been used';
            }
            
            if( empty($data['role']) ){
                $data['role_err'] = 'Please enter the role';
            }
            
            // Make sure no errors
            if ( empty($data['username_err']) && empty($data['role_err']) ){

                $response = $this->service->register($data);
                if( $this->service->update($data) ){
                  flash('msg_error', $response->errorInfo[2], 'snackbar-error');
                  $this->view('users/edit', $data, $opt);
                } else{
                  flash('msg_success', 'New user created');
                  redirect('users');
                }
            }
        } 

        $this->view('users/edit', $data, $opt);
    }

    public function deletes(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data = $_POST['IDS'];
          
            $response = $this->service->deleteMany($data);
            if( $this->service->update($data) ){
              flash('msg_error', $response->errorInfo[2], 'snackbar-error');
            } else{
              flash('msg_success', 'User deleted');
            }
        }
        
        redirect('users');
    }

}
