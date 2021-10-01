<?php
    
    class Customers extends Controller
    {
        public function __construct()
        {
          $this->service = $this->model('Customer');
        }
        
        public function get_by_hp($hp){ //08987726754
            $data = $this->service->findOne('hp', $hp);
            if($data){
                return jsonHttpResponse($data);
            }else{
                return jsonHttpResponse($data, 404, 'customer not found');
            }
        }
    
        public function add()
        {
            $data = [
                'name' => '',
                'hp' => '',
                'email' => '',
                'name_err' => '',
                'hp_err' => '',
                'email_err' => ''
            ];

            //Check for POST
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                // Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                // Process form
                $data['name'] = trim(strtolower($_POST['name']));
                $data['hp'] = trim(strtolower($_POST['hp']));
                $data['email'] = trim($_POST['email']);
            
                // Validate Name
                if ( empty($data['name']) ) {
                    $data['name_err'] = 'Please inform the name of user';
                }

                $userName = $this->service->findOne('name', $data['name']);

                if($userName){
                    $data['name_err'] = 'Name already used';
                }
                
                // Validate HP
                if ( empty($data['hp']) ) {
                    $data['hp_err'] = 'Please inform the whatsapp number of user';
                }

                $userHp = $this->service->findOne('hp', $data['hp']);

                if($userHp){
                    $data['hp_err'] = 'Whatsapp already used';
                }
                
                // Validate Email
                if ( empty($data['email']) ) {
                    $data['email_err'] = 'Please inform the email of user';
                }

                $userEmail = $this->service->findOne('email', $data['email']);

                if($userEmail){
                    $data['email_err'] = 'Email already used';
                }
            
                //Make sure errors are empty
                if ( empty($data['name_err']) && empty($data['hp_err']) && empty($data['email_err']) ) {
                    // Hash Password
                    //$data['password'] = password_hash($data['hp'], PASSWORD_DEFAULT);
                
                    if ( $this->service->create($data) ) {
                        return jsonHttpResponse($data);
                    } else {
                        return jsonHttpResponse($data, 500, 'something wrong');
                    }
                }
            }
            
            return jsonHttpResponse($data, 400, 'only method post');
        }
    }
