<?php
   
   class Dashboard extends Controller
    {
      
      public function __construct()
      {
        if(!isLoggedIn() ){
           redirect('auth/login');
        }
    
        $this->orderModel = $this->model('Order');
      }

       public function index()
       {
         $data = $this->orderModel->find();
         $top = $this->orderModel->groupByProduct(5);
         
         $horizontal = [];
         $vertical = [];
         $i = 0;
         $year = date("Y");
         $summary =  $this->orderModel->sumMonth((int) $year);
         
         foreach($summary as $row){
            $i++;
            if((int) $row->month == 1) $horizontal[$i] = 'January';
            if((int) $row->month == 2) $horizontal[$i] = 'February';
            if((int) $row->month == 3) $horizontal[$i] = 'March';
            if((int) $row->month == 4) $horizontal[$i] = 'April';
            if((int) $row->month == 5) $horizontal[$i] = 'May';
            if((int) $row->month == 6) $horizontal[$i] = 'June';
            if((int) $row->month == 7) $horizontal[$i] = 'July';
            if((int) $row->month == 8) $horizontal[$i] = 'August';
            if((int) $row->month == 9) $horizontal[$i] = 'September';
            if((int) $row->month == 10) $horizontal[$i] = 'October';
            if((int) $row->month == 11) $horizontal[$i] = 'November';
            if((int) $row->month == 12) $horizontal[$i] = 'December';
            
            $vertical[$i] = $row->total_value;
         }
         
         $opt = [ 'top' => $top, 'horizontal' => $horizontal, 'vertical' => $vertical ];
    
         $this->view('dashboards/index', $data, $opt);
       }
    }