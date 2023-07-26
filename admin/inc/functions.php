<?php

require(__DIR__ . '/../../inc/functions.php');
require('auth.php');


function get_category_from_db($id) {
    global $db;
    $query = "SELECT * FROM categories WHERE id=:id";

    $statement = $db->prepare($query);

    $statement->execute(array(':id' => $id));

    $rows = $statement->fetchAll();

    return $rows[0] ?? null;
}



function save_image($image, $dir) {
    $max_size = 5 * 1024 * 1024; // Максимальний розмір 5MB

    if ($image['size'] > $max_size) {
        exit("Помилка: Файл перевищує дозволений розмір 5MB.");
    }

    $saved = move_uploaded_file($image['tmp_name'], $dir . $image['name']);

    if ($saved) {
        return $image['name'];
    } else {
        exit("Помилка: Невдалося завантажити файл на сервер.");
    }
}

function folder_save_image($id, $table, $dir, $object) {

    $item = db_select($table, ["image"], ["id" => $id])[0];

    if ($item['image']) {
        unlink($dir . $item['image']);
    }

    $file_name = save_image($object, $dir);

    if ($file_name) {
        db_update($table, ['image' => $file_name], ['id' => $id]);
    }

    return true;
}



function images_delete($dir, $main_image, $extra_images) {
    if (!empty($main_image['image'])) {
        if (!unlink($dir . $main_image['image'])) {
            add_user_message('error', 'Помилка у видаленні головної картинки: ' . $main_image['image'] . '!');
        }
    }

    foreach ($extra_images as $extra_image) {
        if (!empty($extra_image['image'])) {
            if (!unlink($dir . $extra_image['image'])) {
                add_user_message('error', 'Помилка у видаленні додаткової картинки: ' . $extra_image['image'] . '!');
            }
        }
    }

}

function get_status_style($status) {
    return match ($status) {
        "new" => "primary",
        'in_progress' => "warning",
        "completed" => "success",
        "canceled" => "danger",
        default => "secondary",
    };
}

function get_status_cyrilic($status) {
    return match ($status) {
        "new" => "Нове",
        'in_progress' => "В процесі",
        "completed" => "Виконано",
        "canceled" => "Скасовано",
        default => $status,
    };
}

function get_delivery_cyrilic($delivery) {
    return match ($delivery) {
        "novaposhta" => "Нова пошта",
        'pickup' => "Самовивіз",
        "courier" => "Доставка кур'єром",
        default => $delivery,
    };
}

function get_payment_cyrilic($payment) {
    return match ($payment) {
        "cash" => "Готівка",
        'props' => "Оплата за реквізитами",
        "postpaid" => "Післяоплата",
        default => $payment,
    };
}

function selected_if($input_value, $order_value) {
    return $input_value == $order_value ? "selected" : ""; 
}

