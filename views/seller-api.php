<?php

class SellerApi {
  
    public function outputSellers(array $sellers): void {
        $json = [
            'seller-count' => count($sellers),
            'result' => $sellers
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }

   
    public function outputSellerWithProducts($seller, $products, $totalProducts, $soldProducts, $totalSale) {
        if ($seller) {
            $totalProducts = count($products);
            $soldProducts = $soldProducts[0]['sold_products'];
            $totalSale = $totalSale[0]['total_sale'];

            $response = [
                'success' => true,
                    'seller' => $seller,
                    'total_products' => $totalProducts,
                    'sold_products' => $soldProducts,
                    'total_sale' => $totalSale,
                    'products' => $products

            ];
        } else {
            $response = ['success' => false, 'message' => 'Säljaren hittades inte'];
        }

        header("Content-Type: application/json");
        echo json_encode($response);
    }

}

