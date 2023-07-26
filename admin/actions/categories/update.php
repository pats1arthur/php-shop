<?php

require('../../inc/functions.php');

$upload_path = "../../../uploads/categories/";
if (!db_update("categories", $_POST, ['id' => $_POST['id']])) {
    add_user_message('error', 'Не вдалося оновити категорію в бд!');
}
if (!empty($_FILES['new_image']['name'])) {
    if (!folder_save_image($_POST['id'], "categories", $upload_path, $_FILES['new_image'])) {
        add_user_message('error', 'Не вдалося зберегти картинку: ' . $_FILES['new_image']['name'] . '!');
    }
} 

add_user_message('success', 
    'Категорію <a href="category-form.php?id=' . $_POST['id'] . '">' . htmlentities($_POST['name']) . '</a> успішно оновлено!'
);

redirect("../../categories.php");