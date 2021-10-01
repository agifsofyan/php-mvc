<?php


    class Product
    {
       private $db;

       public function __construct()
       {
           $this->db = new Database();
           $this->table = 'products';
           $this->order = 'orders';
           $this->field = array('id', 'name', 'stock', 'price', 'slug', 'image', 'description', 'created_by', 'is_active', 'created_at', 'updated_at');
       }

       public function toMenu()
       {
           $this->db->query(
                'SELECT id, name FROM '.$this->table.' ORDER BY name ASC'
            );
           return $this->db->resultSet();
       }

       public function list()
       {
           $this->db->query(
                'SELECT a.*, b.qty, COUNT(b.id) AS in_order, SUM(b.status = "paid") AS in_order_paid, b.total_price FROM '.$this->table.' AS a LEFT JOIN '.$this->order.' AS b ON a.id = b.product_id GROUP BY a.id ORDER BY a.created_at DESC'
            );
           return $this->db->resultSet();
       }

       public function findByName($name){
           $this->db->query('select * from '.$this->table.' where name = :name');
           $this->db->bind(':name',$name);
           return $this->db->single();
       }

       public function show($id)
       {
           $this->db->query('select * from '.$this->table.' where id = :id');
           $this->db->bind(':id',$id);
           return $this->db->single();
       }
       
       public function store($data)
       {
           $this->db->query('INSERT INTO products (name, slug, price, image, description, created_by) VALUES (:name, :slug, :price, :image, :description, :created_by)');
           
           // Bind values
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':slug', $data['slug']);
           $this->db->bind(':price', $data['price']);
           $this->db->bind(':image', $data['image']);
           $this->db->bind(':description', $data['description']);
           $this->db->bind(':created_by', $data['created_by']);
            
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
       }

       public function update($data)
       {

          $query = $this->db->query('UPDATE '.$this->table.' SET name = :name, price = :price, is_active = :is_active, slug = :slug, image = :image, description = :description, updated_at = :updated_at where id = :id');
           // Bind values
           $this->db->bind(':id', $data['id']);
           $this->db->bind(':name', $data['name']);
           $this->db->bind(':price', $data['price']);
           $this->db->bind(':is_active', $data['is_active']);
           $this->db->bind(':updated_at', $data['updated_at']);
           $this->db->bind(':slug', $data['slug']);
           $this->db->bind(':image', $data['image']);
           $this->db->bind(':description', $data['description']);
           
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

       public function deleteMany($data)
       {
            $this->db->query('DELETE FROM '.$this->table.' WHERE id IN ('.implode(",", $data).')');
            
            try{
               return $this->db->execute();
            }catch(\Throwable $th){
                return $th;
            }
        }
    }
