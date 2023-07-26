<?php

require('../../inc/functions.php');

$deleteIndex = false;

foreach ($_SESSION['cart'] as $index => &$product) {
    if ($product['id'] == $_GET['product_id']) {
        $product['count'] = $_GET['count'];

        if ($product['count'] == 0) {
            $deleteIndex = $index;
        }
    }
}

if ($deleteIndex !== false) {
    unset($_SESSION['cart'][$deleteIndex]);
}

echo json_encode([
    "cart" => $_SESSION['cart'],
]);