<?php

class CategoryApi {

    public function outputCategories(array $categories): void {

        $json = [
            'category-count' => count($categories),
            'result' => $categories
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }

}

?>