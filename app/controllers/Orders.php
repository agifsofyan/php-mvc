<?php

class Orders extends Controller
{
  
  public function __construct()
  {
    if(!isLoggedIn() ){
       redirect('auth/login');
    }
    
    $this->orderModel = $this->model('Order');
    $this->customerModel = $this->model('Customer');
    $this->productModel = $this->model('Product');
    $this->paymentModel = $this->model('Payment');
  }
  
  public function index()
  {
    $data = $this->orderModel->find();
    $products = $this->productModel->toMenu();
    $payments = $this->paymentModel->list('title', 'asc');

    $opt = [
    'products' => $products,
    'payments' => $payments	
    ];
    
    $this->view('orders/index', $data, $opt);
  }
  
  public function add()
  {
    $data = [
      'hp' => '',
      'name' => '',
      'email' => '',
      'product_id' => '',
      'customer_id' => '',
      'total_price' => '',
      'qty' => '',
      'hp_err' => '',
      'name_err' => '',
      'email_err' => '',
      'product_id_err' => '',
    ];
    
    $product = $this->productModel->toMenu();
    
    $opt = ['product' => $product];
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      // Customer
      $data['name'] = trim($_POST['name']);
      $data['hp'] = trim($_POST['hp']);
      $data['email'] = trim($_POST['email']);

      // Order
      $data['product_id'] = trim($_POST['product_id']);
      $data['qty'] = 1;
      $data['unique_number'] = unique(3);
      
      if ( empty($data['hp']) ) {
        $data['hp_err'] = 'Customer mobile number is required';
      }

      if ( empty($data['name']) ) {
        $data['name_err'] = 'Customer name is required';
      }

      if ( empty($data['email']) ) {
        $data['email_err'] = 'Customer email is required';
      }

      // Validate product id
      if ( empty($data['product_id']) ) {
          $data['product_id_err'] = 'Please select the product';
      }else{
        $product = $this->productModel->show($data['product_id']);
        
        var_dump($data['product_id']);
        if(empty($product)){
          $data['product_id_err'] = 'Product not found';
        }
        $data['total_price'] = $data['unique_number'] + $product->price;

      }
      
      $userHp = $this->customerModel->findOne('hp', $data['hp']);

      if($userHp){
        if($data['name'] !== $userHp->name){
            $data['name_err'] = 'Hp exists & the name not match';
        }

        if($data['email'] !== $userHp->email){
            $data['email_err'] = 'Hp exists & the email not match';
        }
        
        $data['customer_id'] = $userHp->id;
      }else{
        $userName = $this->customerModel->findOne('name', $data['name']);

        if($userName){
            $data['name_err'] = 'Name already used';
        }
        
        $userEmail = $this->customerModel->findOne('email', $data['email']);

        if($userEmail){
            $data['email_err'] = 'Email already used';
        }
       
        //Make sure errors are empty
        if ( empty($data['name_err']) && empty($data['hp_err']) && empty($data['email_err']) ) {

            $cResponse = $this->customerModel->create($data);
            if( isset($cResponse->errorInfo) ){
              flash('msg_error', $cResponse->errorInfo[2], 'snackbar-error');
              $this->view('orders/add', $data, $opt);
            } else{
              $user = $this->customerModel->findOne('hp', $data['hp']);
              $data['customer_id'] = $user->id;
            }
        }
      }

      if(!empty($data['customer_id']) && !empty($data['product_id'])){
        
        $checkOrder = $this->orderModel->isValidOrder($data['customer_id'], $data['product_id'], 'unpaid');
        
        $newQty = (int) $checkOrder->qty + (int) $data['qty'];
        
        $oResponse = '';
        
        if($checkOrder){
          $newQty = $checkOrder->qty + $data['qty'];
          
          $oResponse = $this->orderModel->updateQty($checkOrder->id, $newQty);
          
        }else{
          $oResponse = $this->orderModel->create($data);
        }

        if( isset($oResponse->errorInfo) ){
          flash('msg_error', $oResponse->errorInfo[2], 'snackbar-error');
          $this->view('orders/add', $data, $opt);
        } else{
          flash('msg_success', 'New order added');
          redirect('orders');
        }      
      }
    }
    
    $this->view('orders/add', $data, $opt);
  }

  public function new()
  {
    $customer = [
      'name_err' => '',
      'hp_err' => '',
      'email_err' => ''
    ];
    
    $order = ['product_id_err' => ''];
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $order['product_id'] = trim($_POST['product_id']);
      $order['qty'] = 1;
      $order['payment_id'] = trim($_POST['payment_id']);
      $order['unique_number'] = unique(3);
      
      // Process form
      $customer['name'] = trim($_POST['name']);
      $customer['hp'] = trim($_POST['hp']);
      $customer['email'] = trim($_POST['email']);
      
      $product = $this->productModel->show($order['product_id']);
      
      if(empty($product)){
        $order['product_id_err'] = 'Product not found';
      }
      
      $order['total_price'] = $order['unique_number'] + $product->price;
      
      // Validate HP
      if ( empty($customer['hp']) ) {
          $customer['hp_err'] = 'Please inform the whatsapp number of user';
      }
      
      // Validate Name
      if ( empty($customer['name']) ) {
          $customer['name_err'] = 'Please inform the name of user';
      }
      
      // Validate Email
      if ( empty($data['email']) ) {
          $data['email_err'] = 'Please inform the email of user';
      }

      $userHp = $this->customerModel->findOne('hp', $customer['hp']);

      if($userHp){
        if($customer['name'] !== $userHp->name){
            $customer['name_err'] = 'Hp exists & the name not match';
        }

        if($customer['email'] !== $userHp->email){
            $customer['email_err'] = 'Hp exists & the email not match';
        }
        
        $order['customer_id'] = $userHp->id;
      }else{
        $userName = $this->customerModel->findOne('name', $customer['name']);

        if($userName){
            $customer['name_err'] = 'Name already used';
        }
        
        $userEmail = $this->customerModel->findOne('email', $customer['email']);

        if($userEmail){
            $customer['email_err'] = 'Email already used';
        }
       
        //Make sure errors are empty
        if ( empty($customer['name_err']) && empty($customer['hp_err']) && empty($customer['email_err']) ) {
            // Hash Password
            //$customer['password'] = password_hash($customer['hp'], PASSWORD_DEFAULT);
            
            $cResponse = $this->customerModel->create($customer);
            if( isset($cResponse->errorInfo) ){
              return jsonHttpResponse($customer, 500, $cResponse->errorInfo);
            } else{
              $user = $this->customerModel->findOne('hp', $customer['hp']);
              $order['customer_id'] = $user->id;
            }
            
        }else{
          $invalidate = [$customer['hp_err'], $customer['name_err'], $customer['email_err']];
          return jsonHttpResponse($customer, 400, $invalidate);
        }
      }
      
      //return jsonHttpResponse($customer['name_err'], 400);
      
      if( !empty($customer['hp_err']) || !empty($customer['name_err']) || !empty($customer['email_err']) ){
        $invalidate = [$customer['hp_err'], $customer['name_err'], $customer['email_err']];
          return jsonHttpResponse($customer, 400, $invalidate);
      }
      
      $response = $this->orderModel->create($order);
      if( isset($response->errorInfo) ){
        return jsonHttpResponse($order, 500, $response->errorInfo);
      } else{
        return jsonHttpResponse($order);
      }
    }
  }

  public function edit($id)
  {
    $data = $this->orderModel->detail($id);
    
    $product = $this->productModel->toMenu();
    $payment = $this->paymentModel->list('title', 'asc');
    
    $opt = ['product' => $product, 'payment' => $payment, 'error' => ''];
    $data->hp_err = '';
    $data->name_err = '';

    
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $form['payment_id'] = $_POST['payment_id'];
      $form['status'] = isset($_POST['status']) ? 'paid' : 'unpaid';
      $form['status_by'] = $_SESSION['user_id'];

      $form['hp'] = $_POST['hp'];
      $form['name'] = $_POST['name'];

      if ( empty($form['hp']) ) {
        $data->hp_err = 'Please insert the Customer HP';
      }

      if ( empty($form['name']) ) {
        $data->name_err = 'Please insert the Customer Name';
      }else{
        if(!preg_match("/^[a-zA-Z]+$/i", $form['name'])){
          $data->name_err = 'Customer Name can only contain letters'; 
        }
      }

      // Validate product id
      if ( empty($form['payment_id']) ) {
        $opt['error'] = 'Please select the payment';
      }

      if ( empty($opt['error']) && empty($data->hp_err) && empty($data->name_err)) {

        try {
          $this->customerModel->update([
            'id' => (int) $data->customer_id,
            'hp' => $form['hp'],
            'name' => $form['name'],
            'email' => $data->customer_email
          ]);

          $response = $this->orderModel->updateStatus($id, $form);
          if( isset($response->errorInfo) ){
            flash('msg_error', $response->errorInfo[2], 'snackbar-error');
          } else{
            flash('msg_success', 'Order Updated');
            redirect('orders');
          }
        } catch (\Throwable $th) {
          flash('msg_error', $th, 'snackbar-error');
        }     
      }else{
        flash('msg_error', $opt['error'] , 'snackbar-error');
      }
    }
    
    $this->view('orders/edit', $data, $opt);
  }
  
  public function deletes(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data = $_POST['IDS'];
      
      $response = $this->orderModel->deleteMany($data);
      if( isset($response->errorInfo) ){
        flash('msg_error', $response->errorInfo[2], 'snackbar-error');
      } else{
        flash('msg_success', 'Order deleted');
      }
    }
    
    redirect('orders');
  }
}
