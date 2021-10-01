<?php

    class User{

        private $db;

        public function __construct()
        {
            $this->db = new Database();
            $this->table = 'users';
            $this->field = array('id', 'username', 'password', 'role', 'created_at', 'updated_at', 'last_login', 'is_active');
        }

        public function register($data)
        {
            $this->db->query('INSERT INTO '.$this->table.' (username, password, role) values (:username, :password, :role)');
            // Bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':role', $data['role']);
            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }
        
        public function login($username,$password)
        {
            $this->db->query('SELECT * from '.$this->table.' where username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();

            $hashed_password = $row->password;
            if ( password_verify($password,$hashed_password) ) {

                $user = $this->db->query('SELECT * from '.$this->table.' where username = :username');

                $this->db->query('UPDATE '.$this->table.' SET last_login = :last_login where id = :id');

                $this->db->bind(':last_login', date("Y-m-d H:i:s"));
                $this->db->bind(':id', $row->id);

                $this->db->execute();

                return $row;
            } else {
                return false;
            }
        }
    
        public function checkPassword($username,$password)
        {
            $this->db->query('SELECT * from '.$this->table.' where username = :username');
            $this->db->bind(':username', $username);
            $row = $this->db->single();
    
            $hashed_password = $row->password;
            if ( password_verify($password,$hashed_password) ) {
                return $row;
            } else {
                return false;
            }
        }

        public function getUserByUserName($username)
        {
            $this->db->query('SELECT * FROM '.$this->table.' WHERE username = :username');
            // Bind values
            $this->db->bind(':username', $username);
            return $this->db->single();
        }

        public function getUserById($id)
        {
            $this->db->query('SELECT * FROM '.$this->table.' WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            return $this->db->single();
        }
    
        public function updatePassword($data)
        {
            $this->db->query('UPDATE '.$this->table.' SET password = :password where username = :username');
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':username', $data['username']);
            
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }

        public function update($data)
        {
            $this->db->query('UPDATE '.$this->table.' SET username = :username, role = :role, updated_at = :updated_at where id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':updated_at', $data['updated_at']);
            // Execute
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }
    
        public function getUsers()
        {
            $this->db->query('SELECT * FROM '.$this->table);
            return $this->db->resultSet();
    
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
    }