<?php
    include_once 'partials/connect.php';

    class SellerModel {

        protected $table = "sellers";
        private $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        // Hämtar alla säljare och sorterar alfabetiskt
        public function getAllSellers() {
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY firstname ASC';
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll();
        }


        // Hämtar en säljare 
        public function getSellerById(int $sellerId) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :sellers_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['sellers_id' => $sellerId]);
    
            return $statement->fetch();
        }

        public function addSeller(string $firstname, string $lastname, string $email_address) {
            $query = 'INSERT INTO ' . $this->table . ' (firstname, lastname, email_address) VALUES (:firstname,:lastname,:email_address)';
            $statement = $this->pdo->prepare($query);
            $statement->execute([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email_address' => $email_address
            ]);
    
            return $statement->rowCount() > 0;
        }

        // Hämtar säljare med produkter
        public function getSellerWithProducts(int $sellerId) {
            $query = 'SELECT products.id AS product_id, products.name AS product_name, products.description, products.price, sizes.name AS size, categories.name AS category, products.date_received,products.date_sold 
            FROM ' . $this->table . '
            JOIN products ON sellers.id = products.seller_id
            JOIN sizes ON sizes.id = products.size_id
            JOIN categories ON categories.id = products.category_id
            WHERE sellers.id = :seller_id';
            
            $statement = $this->pdo->prepare($query);
            $statement->execute(['seller_id' => $sellerId]);
            
            return $statement->fetchAll();
        }

        // Hämtar antalet inlämnade plagg 
        public function getTotalProductsBySeller(int $sellerId) {
            $query = 'SELECT s.id, s.firstname, s.lastname, COUNT(p.id) AS total_products
            FROM ' . $this->table . ' AS s
            JOIN products AS p ON s.id = p.seller_id
            WHERE s.id = :seller_id
            GROUP BY s.id, s.firstname, s.lastname';
           
            $statement = $this->pdo->prepare($query);
            $statement->execute(['seller_id' => $sellerId]);
                
            return $statement->fetchAll();
            
        }

        // Hämtar antalet sålda produkter
        public function getTotalSoldProductsBySeller(int $sellerId) {
            $query = 'SELECT COUNT(p.date_sold) AS sold_products
            FROM ' . $this->table . ' AS s
            JOIN products AS p ON s.id = p.seller_id
            WHERE s.id = :seller_id AND p.date_sold IS NOT NULL
            GROUP BY s.id';

            $statement = $this->pdo->prepare($query);
            $statement->execute(['seller_id' => $sellerId]);
                
            return $statement->fetchAll();

        }

        // Hämtar den totala försäljningssumman 
        public function getTotalPriceBySeller(int $sellerId) {
            $query = 'SELECT SUM(p.price) AS total_sale
            FROM ' . $this->table . ' AS s
            JOIN products AS p ON s.id = p.seller_id
            WHERE s.id = :seller_id AND p.date_sold IS NOT NULL
            GROUP BY s.id';

            $statement = $this->pdo->prepare($query);
            $statement->execute(['seller_id' => $sellerId]);
                            
            return $statement->fetchAll();
        }
    }

?>