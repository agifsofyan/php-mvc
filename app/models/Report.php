<?php


    class Report
    {
       private $db;

       public function __construct()
       {
           $this->db = new Database();
           $this->orderTable = 'orders';
           $this->field = array(`id`, `title`, `alias`, `vendor`, `account_name`, `account_number`, `is_active`, `created_at`, `updated_at`);
       }

       public function list()
       {
           $this->db->query('select * from '.$this->table.' order by created_at desc');
           return $this->db->resultSet();
       }

       public function findOne($param, $value)
       {
           $this->db->query('select * from '.$this->table.' where '.$param.' = :'.$param);
           $this->db->bind(':'.$param, $value);
           return $this->db->single();
       }
       
       public function store($data)
       {
           $this->db->query('INSERT INTO '.$this->table.' (title, alias, vendor, account_name, account_number) VALUES (:title, :alias, :vendor, :account_name, :account_number)');
           // Bind values
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':alias', $data['alias']);
           $this->db->bind(':vendor', $data['vendor']);
           $this->db->bind(':account_name', $data['account_name']);
           $this->db->bind(':account_number', $data['account_number']);

           // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }

       public function update($data)
       {

          $query = $this->db->query('UPDATE '.$this->table.' SET title = :title, alias = :alias, vendor = :vendor, account_name = :account_name, account_number = :account_number, is_active = :is_active, updated_at = :updated_at where id = :id');
           // Bind values
           $this->db->bind(':id', $data['id']);
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':alias', $data['alias']);
           $this->db->bind(':vendor', $data['vendor']);
           $this->db->bind(':account_name', $data['account_name']);
           $this->db->bind(':account_number', $data['account_number']);
           $this->db->bind(':is_active', $data['is_active']);
           $this->db->bind(':updated_at', $data['updated_at']);

           // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }

       public function delete($id)
       {
           $this->db->query('DELETE FROM '.$this->table.' where id = :id');
           // Bind values
           $this->db->bind(':id', $id);

           // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }
    }