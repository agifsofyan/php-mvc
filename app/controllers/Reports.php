<?php

class Reports extends Controller
{

  public function __construct()
  {
    if(!isLoggedIn() ){
       redirect('auth/login');
    }

    $this->orderModel = $this->model('Order');
    $this->productModel = $this->model('Product');
  }
  
  private function filt($arr, $key, $value){
    return array_filter($arr, function ($var) use($key, $value) {
        return ($var[$key] == $value);
    });
  }

  public function index()
  {
    $data = $this->orderModel->reports();
    
    $month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Des"];
    $year = date("Y");
    $summary =  $this->orderModel->sumMonth((int) $year);
    $customerCount = $this->orderModel->getCount('customer_id');
    $productCount = $this->orderModel->getCount('product_id');
    
    $opt = [
            'month' => $month,
            'prices' => $summary,
            'count_customer' => $customerCount,
            'cout_product' => $productCount
    ];
  
    $this->view('reports/index', $data, $opt);
  }

  public function show($id)
  {
    $data = $this->orderModel->findById($id);
    
    $this->view('reports/show', $data);
  }
}