<?php
    require_once 'classes/db.php';

    class SizeModel extends DB {
        protected $table = "sizes";
    
        // Hämtar alla storlekar 
        public function getAllSizes() {
            $query = 'SELECT * FROM ' . $this->table . ';';
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll();
        }

        // Hämtar en storlek baserat på id
        public function getSizeById($sizeId) {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :sizes_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['size_id' => $sizeId]);
    
            return $statement->fetch();
        }
    }

?>