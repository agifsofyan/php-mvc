<?php

    class Order
    {
       private $db;

       public function __construct()
       {
           $this->db = new Database();
           $this->table = 'orders';
           $this->product = 'products';
           $this->customer = 'customers';
           $this->payment = 'payments';
           $this->admin = 'users';
           $this->field = array('id', 'customer_id', 'product_id', 'qty', 'payment_id', 'unique_number', 'total_price', 'status', 'created_at', 'paid_at', 'status_by');
       }

       public function findById($id)
       {
           $this->db->query('select * from '.$this->table.' where id = :id');
           $this->db->bind(':id',$id);
           return $this->db->single();
       }
       
       public function isValidOrder($userId, $productId, $status)
       {
           $this->db->query('select * from '.$this->table.' where customer_id = :customer_id AND product_id = :product_id AND status = :status');
           $this->db->bind(':customer_id', $userId);
           $this->db->bind(':product_id', $productId);
           $this->db->bind(':status', $status);
           return $this->db->single();
       }
       
       public function updateQty($id, $qty)
       {
          $query = $this->db->query('UPDATE '.$this->table.' SET qty = :qty where id = :id');
           // Bind values
           $this->db->bind(':id', $id);
           $this->db->bind(':qty', $qty);

            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }
       
       public function updateStatus($id, $data)
       {

          $query = $this->db->query('UPDATE '.$this->table.' SET payment_id = :payment_id, status = :status, paid_at = :paid_at, status_by = :status_by where id = :id');
           // Bind values
           $this->db->bind(':id', $id);
           $this->db->bind(':payment_id', (int) $data['payment_id']);
           $this->db->bind(':status', $data['status']);
           $this->db->bind(':paid_at', date("Y-m-d H:i:s"));
           $this->db->bind(':status_by', $data['status_by']);

           // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }
       
       public function create($data)
       {
           $this->db->query('INSERT INTO '.$this->table.' (customer_id, product_id, qty, unique_number, total_price) VALUES (:customer_id, :product_id, :qty, :unique_number, :total_price)');
           // Bind values
           $this->db->bind(':customer_id', (int) $data['customer_id']);
           $this->db->bind(':product_id', (int) $data['product_id']);
           $this->db->bind(':qty', (int) $data['qty']);
           $this->db->bind(':unique_number', (int) $data['unique_number']);
           $this->db->bind(':total_price', (int) $data['total_price']);

           // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }
       
       public function find()
       {
           $this->db->query(
                    'SELECT a.*, b.name AS customer_name, b.hp AS customer_number, c.name AS product_name, d.account_number, e.username AS admin_name FROM '.$this->table.' AS a
                    LEFT JOIN '.$this->customer.' AS b ON a.customer_id=b.id
                    LEFT JOIN '.$this->product.' AS c ON a.product_id=c.id
                    LEFT JOIN '.$this->payment.' AS d ON a.payment_id=d.id
                    LEFT JOIN '.$this->admin.' AS e ON a.status_by=e.id
                    ORDER BY a.created_at DESC'
            );
           return $this->db->resultSet();
       }
       
       public function groupByProduct($limit)
       {
           $this->db->query(
                    'SELECT a.id, a.name, b.qty, COUNT(b.id) AS in_order FROM '.$this->product.' AS a LEFT JOIN '.$this->table.' AS b ON a.id = b.product_id WHERE b.qty > 0 GROUP BY a.id ORDER BY in_order, b.created_at DESC LIMIT '.$limit
            );
           return $this->db->resultSet();
       }
       
       public function reports(){
            $this->db->query(
                    'SELECT
                    a.*,
                    b.name AS customer_name,
                    c.name AS product_name,
                    d.vendor,
                    d.account_name,
                    d.account_number
                    FROM '.$this->table.' AS a
                    LEFT JOIN '.$this->customer.' AS b ON b.id = a.customer_id
                    LEFT JOIN '.$this->product.' AS c ON c.id = a.product_id
                    LEFT JOIN '.$this->payment.' AS d ON d.id = a.payment_id
                    WHERE a.status = "paid"
                    ORDER BY a.created_at DESC'
            );
            return $this->db->resultSet();
       }
       
       public function getCount($param){
            $this->db->query(
                "SELECT *,
                COUNT(".$param.") AS counter
                FROM ".$this->table."
                WHERE status = 'paid'
                GROUP BY ".$param            
            );
            
            return $this->db->resultSet();
       }
       
       public function deleteMany($data)
        {
            $this->db->query('DELETE FROM '.$this->table.' WHERE id IN ('.implode(",", $data).')');
        
            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }
        
        public function sumMonth($year){
            $this->db->query(
                    "select MONTH(created_at) as month, sum(total_price) as total_value from ".$this->table."
                        WHERE YEAR(created_at) = ".$year." AND status = 'paid'
                        group by month"
            );
            
            return $this->db->resultSet();
        }
        
        public function detail($id){
            $this->db->query(
                    'SELECT
                    a.*,
                    b.name AS customer_name,
                    b.hp AS customer_hp,
                    c.name AS product_name,
                    c.price AS product_price,
                    d.vendor,
                    d.account_name,
                    d.account_number
                    FROM '.$this->table.' AS a
                    LEFT JOIN '.$this->customer.' AS b ON b.id = a.customer_id
                    LEFT JOIN '.$this->product.' AS c ON c.id = a.product_id
                    LEFT JOIN '.$this->payment.' AS d ON d.id = a.payment_id
                    WHERE a.id = :id'
            );
            $this->db->bind(':id', $id);
            
            return $this->db->single();
        }
    }