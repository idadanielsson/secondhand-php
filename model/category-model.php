<?php
    require_once 'classes/db.php';

    class CategoryModel extends DB {
        protected $table = "categories";
       
        // Hämtar alla kategorier 
        public function getAllCategories() {
            $query = 'SELECT * FROM ' . $this->table . ';';
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll();
        }

        // Hämtar en kategori baserat på id
        public function getCategoryById($categoryId) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :categories_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['categories_id' => $categoryId]);
    
            return $statement->fetch();
        }
    }
    

?>