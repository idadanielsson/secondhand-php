<?php

require_once 'model/seller-model.php';
require_once 'views/seller-api.php';
require_once 'model/product-model.php';
require_once 'views/product-api.php';
require_once 'model/category-model.php';
require_once 'views/category-api.php';
require_once 'model/size-model.php';
require_once 'views/size-api.php';

$pdo = connect($host, $dbname, $password, $charset);

$sellerModel = new SellerModel($pdo);
$sellerApi = new SellerApi();
$productModel = new ProductModel($pdo);
$productApi = new ProductApi();
$categoryModel = new CategoryModel($pdo);
$categoryApi = new CategoryApi();
$sizeModel = new SizeModel($pdo);
$sizeApi = new SizeApi();

// Hämtar alla säljare och sorterar alfabetiskt 
if (isset($_GET['action'])) {
    $chosenAction = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($chosenAction == 'sellers') {
        $sellerApi->outputSellers($sellerModel->getAllSellers());
    }    
}

if ($chosenAction == 'sellers-id') {
    if (isset($_GET['id'])) {
        $sellerId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $seller = $sellerModel->getSellerById($sellerId);
        $products = $sellerModel->getSellerWithProducts($sellerId);
        $soldProducts = $sellerModel->getTotalSoldProductsBySeller($sellerId);
        $totalSale = $sellerModel->getTotalPriceBySeller($sellerId);
        $sellerApi->outputSellerWithProducts($seller, $products, $totalProducts, $soldProducts, $totalSale);
    }
}

// Lägger till säljare
if (isset($_GET['action'])) {
    $chosenAction = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($chosenAction == 'add-seller') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json_data = file_get_contents('php://input');
            $data = json_decode($json_data, true);

            if (isset($data['firstname'], $data['lastname'], $data['email_address'])) {
                $firstName = filter_var($data['firstname'], FILTER_SANITIZE_SPECIAL_CHARS);
                $lastName = filter_var($data['lastname'], FILTER_SANITIZE_SPECIAL_CHARS);
                $email_address = filter_var($data['email_address'], FILTER_SANITIZE_SPECIAL_CHARS);

                $success = $sellerModel->addSeller($firstName, $lastName, $email_address);

                if ($success) {
                    $response = [
                        'success' => true,
                        'message' => 'Seller added'
                    ];
                } 
                echo json_encode($response);
                exit;
            }
        }
    }
}
// Hämtar alla produkter
if (isset($_GET['action'])) {
    $chosenAction = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($chosenAction == 'products') {
        $products = $productModel->getAllProducts();
        $productApi->outputProducts($products);
    }         
}

// Hämtar en produkt baserat på id
if ($chosenAction == 'products-id') {
    if (isset($_GET['id'])) {
            $productId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $product = $productModel->getProductById($productId);
            $productApi->outputProductById($product);
    }
}

// Lägger till produkter
if (isset($_GET['action'])) {
    $chosenAction = filter_var($_GET['action'], FILTER_SANITIZE_SPECIAL_CHARS);

    if ($chosenAction == 'add-product') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json_data = file_get_contents('php://input');
            $data = json_decode($json_data, true);

            if (isset($data['name'], $data['description'], $data['price'], $data['category_id'], $data['seller_id'], $data['size_id'])) {
                $name = filter_var($data['name'], FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);
                $price = filter_var($data['price'], FILTER_SANITIZE_NUMBER_INT);
                $category_id = filter_var($data['category_id'], FILTER_SANITIZE_NUMBER_INT);
                $seller_id = filter_var($data['seller_id'], FILTER_SANITIZE_NUMBER_INT);
                $size_id = filter_var($data['size_id'], FILTER_SANITIZE_NUMBER_INT);

                $success = $productModel->addProduct($name, $description, $price,  $category_id, $seller_id, $size_id);

                if ($success) {
                    $response = [
                        'success' => true,
                        'message' => 'Produkten har lagts till'
                    ];
                } 
                echo json_encode($response);
                exit;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['action']) && $_GET['action'] === 'update-product') {
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    if (isset($data['id'])) {
        $product_id = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);
        
        $success = $productModel->markProductAsSold($product_id);

        if ($success) {
            $response = [
                'success' => true,
                'message' => 'Product marked as sold'
            ];
        }
        echo json_encode($response);
        exit;
    }
}

?>