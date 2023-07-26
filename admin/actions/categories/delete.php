<?php

require('../../inc/functions.php');

$category_id = $_GET['id'];
$upload_path = "../../../uploads/categories/";

$item = db_select("categories", ["image"], ["id" => $category_id])[0];
if (!db_delete("categories", ["id" => $category_id]))
    add_user_message('error', 'Не вдалося видалити категорію з бд!');
if (!empty($item["image"]))
    if (!unlink($upload_path . $item["image"]))
        add_user_message('error', 'Не вдалося видалити картинку: ' . $item["image"] . ' !');

add_user_message('success', 'Категорію було успішно видалено!');

redirect("../../categories.php");


