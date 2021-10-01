<?php

class Payments extends Controller
{

  public function __construct()
  {
    if(!isLoggedIn() ){
       redirect('auth/login');
    }

    $this->service = $this->model('Payment');
  }

  public function index()
  {
    $data = $this->service->list();
  
    $this->view('payments/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => '',
      'alias' => '',
      'vendor' => '',
      'account_name' => '',
      'account_number' => '',
      'title_err' => '',
      'vendor_err' => '',
      'account_name_err' => '',
      'account_number_err' => '',
    ];

    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $data['title'] = trim(strtolower($_POST['title']));
      $data['alias'] = trim(strtolower($_POST['alias']));
      $data['vendor'] = trim(strtoupper($_POST['vendor']));
      $data['account_name'] = trim(strtoupper($_POST['account_name']));
      $data['account_number'] = trim((int) $_POST['account_number']);
      
      // Validate title
      if( empty($data['title']) ){
         $data['title_err'] = 'Please insert the title';
      }
      
      // Validate vendor
      if( empty($data['vendor']) ){
         $data['vendor_err'] = 'Please insert the vendor';
      }
      
      // Validate account name
      if( empty($data['account_name']) ){
         $data['account_name_err'] = 'Please insert the account name';
      }

      // Validate account_number
      if( empty($data['account_number']) ){
         $data['account_number_err'] = 'Please insert the account number';
      }

      $paymentTitle = $this->service->findOne('account_number', $data['account_number']);

      if($paymentTitle){
        $data['account_number_err'] = 'Account Number has been used';
      }

      // Make sure no errors
      if ( empty($data['title_err']) && empty($data['vendor_err']) && empty($data['account_name_err']) && empty($data['account_number_err']) ){
      
        $response = $this->service->store($data);
        if( isset($response->errorInfo) ){
          flash('msg_error', $response->errorInfo[2], 'snackbar-error');
          $this->view('payments/add', $data);
        } else{
          flash('msg_success', 'Payment Added');
          redirect('payments');
        }
      }
    }
    
    $this->view('payments/add', $data);
  }

  public function edit($id)
  {
    // Get existing post from model
    $query = $this->service->findOne('id', $id);

    $data = [
      'id' => $id,
      'title' => $query->title,
      'alias' => $query->alias,
      'vendor' => $query->vendor,
      'account_name' => $query->account_name,
      'account_number' => $query->account_number,
      'is_active' => $query->is_active,
      'title_err' => '',
      'vendor_err' => '',
      'account_name_err' => '',
      'account_number_err' => '',
    ];

    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $data['title'] = trim(strtolower($_POST['title']));
      $data['alias'] = trim(strtolower($_POST['alias']));
      $data['vendor'] = trim(strtoupper($_POST['vendor']));
      $data['account_name'] = trim(strtoupper($_POST['account_name']));
      $data['account_number'] = trim((int) $_POST['account_number']);
      $data['is_active'] = isset($_POST['is_active']) ? true : false;
      $data['updated_at'] = date("Y-m-d H:i:s");

      // Validate title
      if( empty($data['title']) ){
         $data['title_err'] = 'Please insert the title';
      }
      
      // Validate vendor
      if( empty($data['vendor']) ){
         $data['vendor_err'] = 'Please insert the vendor';
      }
      
      // Validate account name
      if( empty($data['account_name']) ){
         $data['account_name_err'] = 'Please insert the account name';
      }

      // Validate account_number
      if( empty($data['account_number']) ){
         $data['account_number_err'] = 'Please insert the account number';
      }

      $paymentTitle = $this->service->findOne('account_number', $data['account_number']);

      if($paymentTitle && $paymentTitle->id != $id){
        $data['account_number_err'] = 'Account Number has been used';
      }

      // Make sure no errors
      if ( empty($data['name_err']) && empty($data['price_err']) ){
        $response = $this->service->update($data);
        if( isset($response->errorInfo) ){
          flash('msg_error', $response->errorInfo[2], 'snackbar-error');
          $this->view('payments/edit', $data);
        } else{
          flash('msg_success', 'Payment updated');
          redirect('payments');
        }
      }
    } 
    
    $this->view('payments/edit', $data);
  }

  public function show($id)
  {
    $data = $this->service->findOne('id', $id);
    
    $this->view('payments/show', $data);
  }

  public function deletes(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data = $_POST['IDS'];
      
      $response = $this->service->deleteMany($data);
      if( isset($response->errorInfo) ){
        flash('msg_error', $response->errorInfo[2], 'snackbar-error');
      } else{
        flash('msg_success', 'Payment deleted');
      }
    }
    
    redirect('payments');
  }
}