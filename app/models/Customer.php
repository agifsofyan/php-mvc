<?php


    class Customer
    {
        private $db;

        public function __construct()
        {
           $this->db = new Database();
           $this->table = 'customers';
           $this->field = array('id', 'name', 'hp', 'email', 'created_at', 'updated_at');
        }
       
        public function findOne($param, $value){
           $this->db->query('select * from '.$this->table.' where '.$param.' = :'.$param);
           $this->db->bind(':'.$param, $value);
           return $this->db->single();
        }
       
        public function create($data)
        {
           $this->db->query('INSERT INTO '.$this->table.' (hp, name, email) VALUES (:hp, :name, :email)');
           // Bind values
           $this->db->bind(':hp', $data['hp']);
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':email', $data['email']);

            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }

        public function update($data)
        {
            $this->db->query('UPDATE '.$this->table.' SET hp = :hp, name = :name, email = :email, updated_at = :updated_at where id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':hp', $data['hp']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':updated_at', date("Y-m-d H:i:s"));
            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }
    }