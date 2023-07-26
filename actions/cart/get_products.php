<?php

require('../../inc/functions.php');

$cartProducts = $_SESSION['cart'] ?? [];
$total_price = 0;
$total_count = 0;

if ($cartProducts) {
    $id_array = [];
    foreach ($cartProducts as $product) {
        $id_array[] = $product['id'];
    }

    $products = db_select_raw("SELECT * FROM products WHERE id IN (" . implode(",", $id_array) . ")");

    foreach ($cartProducts as &$cartProduct) {
        foreach ($products as $product) {
            if ($product['id'] == $cartProduct['id']) {
                $cartProduct['name'] = $product['name'];
                $cartProduct['price'] = $product['price'];
                $cartProduct['image'] = img("products/" . $product["image"]);
                $cartProduct['total_price'] = $product['price'] * $cartProduct['count'];
            }
        }
    }

    unset($cartProduct);

    foreach ($cartProducts as $cartProduct) {
        $total_price += $cartProduct['total_price'];
        $total_count += $cartProduct['count'];
    }

}

echo json_encode([
    'products' => $cartProducts,
    'total_price' => $total_price,
    'total_count' => $total_count,
]);