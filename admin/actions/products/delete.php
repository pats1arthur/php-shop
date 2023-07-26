<?php

require('../../inc/functions.php');

$product_id = $_GET['id'];
$upload_path = "../../../uploads/products/";

$main_image = db_select("products", ["image"], ["id" => $product_id])[0];
$extra_images = db_select("product_images", ["image"], ["product_id" => $product_id]);

images_delete($upload_path, $main_image, $extra_images);

if (!db_delete("products", ["id" => $product_id])) {
    add_user_message('error', 'Помилка у видаленні товару з бд!');
}

add_user_message('success', 'Товар було успішно видалено!');

redirect("../../products.php");


