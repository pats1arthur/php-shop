<?php

require('../../inc/functions.php');

$upload_path = "../../../uploads/products/";

if (!db_update('products', $_POST, ['id' => $_POST['id']])) {
    add_user_message('error', 'Не вдалося оновити товар в бд!');
}
if(!empty($_FILES['new_image']['name'])) {
    if (folder_save_image($_POST['id'], "products", $upload_path, $_FILES['new_image'])) {
        add_user_message('error', 'Не вдалося зберегти картинку: ' . $_FILES['new_image']['name'] . '!');
    }
}

if(!empty($_FILES['extra_images']['name'][0])) {
    $imagesCount = count($_FILES['extra_images']['name']);
    
    for ($i = 0; $i < $imagesCount; $i++) {
        $image = [
            'name' => $_FILES['extra_images']['name'][$i],
            'tmp_name' => $_FILES['extra_images']['tmp_name'][$i],
            'type' => $_FILES['extra_images']['type'][$i],
            'full_path' => $_FILES['extra_images']['full_path'][$i],
            'error' => $_FILES['extra_images']['error'][$i],
            'size' => $_FILES['extra_images']['size'][$i],
        ];

        if (empty($image['name'])) continue;

        $last_extra_image_id = db_insert("product_images",  ["product_id" => $_POST['id']]);
        if (!$last_extra_image_id) {
            add_user_message('error', 'Не вдалося додаткову картинку ' . $image['name'] . ' до бд!');
        }
        if (!folder_save_image($last_extra_image_id, "product_images", $upload_path, $image)) {
            add_user_message('error', 'Не вдалося зберегти картинку: ' . $image['name'] . '!');
        }
    }
}

add_user_message('success', 'Товар <a href="product-form.php?id=' . $_POST['id'] . '">' . htmlentities($_POST['name']) . '</a> успішно оновлено!');

redirect("../../products.php");