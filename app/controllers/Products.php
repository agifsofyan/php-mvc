<?php

class Products extends Controller
{

  public function __construct()
  {
    if(!isLoggedIn() ){
       redirect('auth/login');
    }

    $this->service = $this->model('Product');
    $this->userModel = $this->model('User');
  }

  public function index()
  {
    $query = $this->service->list();
    $data = [
     'products' => $query
    ];
  
    $this->view('products/index', $data);
  }

  public function add()
  {
    $data = [
      'name' => '',
      'price' => '',
      'slug' => '',
      'image' => '',
      'description' => '',
      'created_by' => '',
      'name_err' => '',
      'price_err' => '' 
    ];

    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $data['name'] = trim(strtolower($_POST['name']));
      $data['price'] = trim(str_replace('.', '', $_POST['price']));
      $data['description'] = trim($_POST['description']);
      $data['created_by'] = trim($_SESSION['user_id']);

      // Validate
      if( empty($data['name']) ){
         $data['name_err'] = 'Please enter the name';
      }

      $product = $this->service->findByName($data['name']);

      if($product){
        $data['name_err'] = 'Product name has been used';
      }

      // Create Slug URL
      $data['slug'] = trim(createUrlSlug($data['name']));

      if( empty($data['price']) ){
         $data['price_err'] = 'Please enter the price';
      }

      if ($_FILES["image"]) {
       
          $filename = $_FILES["image"]["name"];
          $tempname = $_FILES["image"]["tmp_name"];
          $path = "/assets/images/uploads/".$filename;
          $dir = PUBLIC_DIR . $path;

          move_uploaded_file($tempname, $dir);

          $data['image'] = $path;
      }

      // Make sure no errors
      if ( empty($data['name_err']) && empty($data['price_err']) ){
         $response = $this->service->store($data);
         if( isset($response->errorInfo) ){
            flash('msg_error', $response->errorInfo[2], 'snackbar-error');
            $this->view('products/add', $data);
         } else{
            flash('msg_success', 'Product Added');
            redirect('products');
         }
      }
    }
    
    $this->view('products/add', $data);
  }

  public function edit($id)
  {
    // Get existing post from model
    $query = $this->service->show($id);

    $data = [
      'id' => $query->id,
      'name' => $query->name,
      'price' => $query->price,
      'is_active' => $query->is_active,
      'slug' => $query->slug,
      'image' => $query->image,
      'description' => $query->description,
      'updated_at' => $query->updated_at,
      'name_err' => '',
      'price_err' => ''
    ];

    if($_SERVER['REQUEST_METHOD']=='POST'){
      // Sanitize POST Array
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

      $data['id'] = $id;
      $data['name'] = trim(strtolower($_POST['name']));
      $data['price'] = trim(str_replace('.', '', $_POST['price']));
      $data['description'] = trim($_POST['description']);
      $data['created_by'] = $_SESSION['user_id'];
      $data['is_active'] = isset($_POST['is_active']) ? true : false;
      $data['updated_at'] = date("Y-m-d H:i:s");

      // Validate
       if( empty($data['name']) ){
          $data['name_err'] = 'Please enter the name';
       }

       $product = $this->service->findByName($data['name']);
       if($product && $product->id != $id){
          $data['name_err'] = 'Product name has been used';
       }

       // Create Slug URL
       $data['slug'] = createUrlSlug($data['name']);

       if( empty($data['price']) ){
          $data['price_err'] = 'Please enter the price';
       }

       if ($_FILES["image"]) {
          $filename = $_FILES["image"]["name"];
          $tempname = $_FILES["image"]["tmp_name"];
          $path = "/assets/images/uploads/".$filename;
          $dir = PUBLIC_DIR . $path;

          move_uploaded_file($tempname, $dir);

          $data['image'] = $path;
      }else{
        $data['image'] = $query->image;
      }

       // Make sure no errors
       if ( empty($data['name_err']) && empty($data['price_err']) ){
        
          $response = $this->service->update($data);
          
          if( isset($response->errorInfo) ){
            flash('msg_error', $response->errorInfo[2], 'snackbar-error');
            $this->view('products/edit', $data);
          } else{
            flash('msg_success', 'Product Updated');
            redirect('products');
          }
       }
    } 
    
    $this->view('products/edit', $data);
  }

  public function show($id)
  {
    $query = $this->service->show($id);
    $user = $this->userModel->getUserById($query->id);
    $data = [
      'product' => $query,
      'user' => $user
    ];
    
    $this->view('products/show', $data);
  }

  public function deletes(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
      $data = $_POST['IDS'];
      
      $response = $this->service->deleteMany($data);
          
      if( isset($response->errorInfo) ){
         flash('msg_error', $response->errorInfo[2], 'snackbar-error');
      } else{
         flash('msg_error', 'Product deleted');
      }
    }
    
    redirect('products');
  }
}