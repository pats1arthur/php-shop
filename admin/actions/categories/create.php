<?php

require('../../inc/functions.php');

$category_id = db_insert("categories", $_POST);
$upload_path = "../../../uploads/categories/";

if (!$category_id) {
    add_user_message('error', 'Не вдалося зберегти категорію ' . $_POST['name'] . ' до бд!');
}
if (!empty($_FILES['new_image']['name'])) {
    if (!folder_save_image($category_id, "categories", $upload_path, $_FILES['new_image'])) {
        add_user_message('error', 'Не вдалося зберегти картинку: ' . $_FILES['new_image']['name'] . '!');
    }
} else {
    add_user_message('warning', 'Ви не додали картинку до категорії!');
}
add_user_message('success', 'Категорію <a href="category-form.php?id=' . $category_id . '">' . htmlentities($_POST['name']) . '</a> успішно створено!');

redirect("../../categories.php");