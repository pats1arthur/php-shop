<?php

require('../../inc/functions.php');

if (!db_update("orders", $_POST, ['id' => $_POST['id']])) {
    add_user_message('error', 'Не вдалося оновити замовлення в бд!');
}
else {
    add_user_message('success', 
        "<a href='order-form.php?id=" . $_POST['id'] . "'>Замовлення</a> було успішно оновлене."
    );
}

redirect("../../order-form.php?id=" . $_POST['id']);