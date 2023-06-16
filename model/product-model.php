<?php
    require_once 'classes/db.php';

    class ProductModel extends DB {
        protected $table = "products";
   
        // Hämtar alla produkter
        public function getAllProducts() {
            $query = 'SELECT * FROM ' . $this->table . ';';
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll();
        }

        //Hämtar en produkt baserat på id
        public function getProductById($productId) {
            $query = 'SELECT * FROM ' .  $this->table . ' WHERE id = :products_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['products_id' => $productId]);
    
            return $statement->fetch();
        }

        // Lägga till produkter
        public function addProduct(string $name, string $description, int $price, int $category_id, int $seller_id,  int $size_id) {
            $query = 'INSERT INTO ' . $this->table . '(name, description, price, category_id, seller_id, size_id) VALUES (:name, :description, :price, :category_id, :seller_id, :size_id)';
            
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_id' => $category_id,
                'seller_id' => $seller_id, 
                'size_id' => $size_id
            ]);
    
            return $statement->rowCount() > 0;
        }


        public function markProductAsSold(int $product_id) {
            $query = 'UPDATE ' . $this->table . ' SET date_sold = NOW() WHERE id = :product_id';
            
            $statement = $this->pdo->prepare($query);
            $statement->execute(['product_id' => $product_id]);
            
            return $statement->rowCount() > 0;
        }
    }

?>