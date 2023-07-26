<?php

require('../../inc/functions.php');

$delivery_details = '';

if ($_POST['delivery'] == 'novaposhta') {
    $delivery_details = 'місто: ' . $_POST['city-np'] . ', відділення: ' . $_POST['branch-np'];
}
else if ($_POST['delivery'] == 'courier') {
    $delivery_details = 'місто: ' . $_POST['city-courier'] . ', вулиця: ' . $_POST['street-courier'] . ', будинок: ' . $_POST['house-courier'] . ', квартира: ' . $_POST['apartment-courier'];
}

$order_info = [
    'first_name' => htmlentities($_POST['firstName']),
    'last_name' => htmlentities($_POST['lastName']),
    'phone_number' => htmlentities($_POST['phoneNumber']),
    'delivery' => $_POST['delivery'],
    'delivery_details' => htmlentities($delivery_details),
    'payment' => $_POST['payment'],
];

$order_id = db_insert('orders', $order_info);

$id_array = [];
foreach ($_SESSION['cart'] as $product) {
    $id_array[] = $product['id'];
}
$products = db_select_raw("SELECT id,price FROM products WHERE id IN (" . implode(",", $id_array) . ")");

$total_price = 0.0;

foreach ($_SESSION['cart'] as $cart_item) {
    foreach ($products as $product) {
        if ($product['id'] == $cart_item['id']) {
            $item = [
                'order_id' => $order_id,
                'product_id' => $cart_item['id'],
                'count' => $cart_item['count'],
                'price' => $product['price'],
                'total_price' => $cart_item['count'] * $product['price'],
            ];

            $total_price += $item['total_price'];

            $order_product_id = db_insert('order_products', $item);
        }
    }
}

db_update('orders', ['total_price' => $total_price], ['id' => $order_id]);

add_report('success', 'Дякуємо за покупку!', "Очікуйте на дзвінок від адіністратора для з'ясування подальших обставин", "Перейти на <a href='/index.php'>головну сторінку</a>");

$_SESSION['cart'] = [];

redirect("/message.php");

