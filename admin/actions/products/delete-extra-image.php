<?php 
require('../../inc/functions.php');

$upload_path = "../../../uploads/products/";

$extra_image = db_select("product_images", ["product_id", "image"], ["id" => $_GET['image_id']])[0];
if (!unlink($upload_path . $extra_image["image"])) {
    add_user_message('error', 'Не вдалося видалити картинку: ' . $extra_image["image"] . ' !');
}
if (!db_delete("product_images", ["id" => $_GET['image_id']])) {
    add_user_message('error', 'Не вдалося видалити картинку: ' . $extra_image["image"] . ' з бд!');
}

add_user_message('success', "Картинку " . $extra_image["image"] . " було успішно видалено");
redirect("../../product-form.php?id=" . $extra_image['product_id']);