<?php

require('../../inc/functions.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$is_new_product = true;

foreach ($_SESSION['cart'] as &$product) {
    if ($product['id'] == $_GET['product_id']) {
        $product['count']++;
        $is_new_product = false;
    }
}

if ($is_new_product) {
    $_SESSION['cart'][] = [
        "id" => $_GET['product_id'],
        "count" => 1,
    ];
}

echo json_encode([
    'cart' => $_SESSION['cart'],
]);