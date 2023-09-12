<?php

require('config.php');

$db = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);

session_start();

function debug($var) {
   echo '<pre>';
   print_r($var);
   die;
}


register_shutdown_function(function () {
    $error = error_get_last();
    if ($error) http_response_code(500);
});

function redirect($path) {
    header("Location: $path");
    exit;
}

function active_if_path($path) {
    if ($path == $_SERVER['REQUEST_URI']) {
        echo 'active';
    }
}

function img($image) {
    return "/uploads/" . htmlspecialchars($image);
}

function get_categories_from_db() {
    global $db;
    $categories = $db->query("SELECT * FROM categories");
    return $categories;
}

function get_product_from_db($id) {
    global $db;
    $query = "
        SELECT
            p.*,
            c.name AS category_name
        FROM
            products p
        LEFT JOIN
            categories c ON c.id = p.category_id
        WHERE
            p.id = :id
    ";


    $statement = $db->prepare($query);

    $statement->execute(array(':id' => $id));

    $rows = $statement->fetchAll();

    return $rows[0] ?? null;
}

function get_products_from_db() {
    global $db;
    $products = $db->query("
        SELECT
            p.*,
            c.name AS category_name
        FROM
            products p
        LEFT JOIN
            categories c ON c.id = p.category_id
    ");
    return $products;
}

function db_select($table, $columns ,$where) {
    global $db;
    $query = "SELECT " . implode(",", $columns) . " FROM " . $table . " WHERE " . array_to_sql_params($where);

    $statement = $db->prepare($query);

    foreach ($where as $key => $value) {
        $statement->bindParam(':' . $key, $value);
    }

    $statement->execute();


    return $statement->fetchAll();
}

function db_select_raw($sql, $params = []) {
    global $db;
    
    $statement = $db->prepare($sql);

    if ($params) {
        foreach ($where as $key => $value) {
            $statement->bindParam(':' . $key, $value);
        }
    }

    $statement->execute();

    return $statement->fetchAll();
}

function db_select_one($table, $columns ,$where) {
    $rows = db_select($table, $columns ,$where);
    return $rows[0] ?? null;
}


function db_insert($table, $data) {
    global $db;
    
    $values = array_keys($data);

    $values = array_map(function($item) {
        return ":" . $item;
    }, $values);

    $query = "INSERT INTO $table (" . implode(",", array_keys($data)) . ") VALUES (" . implode(",", $values) .")";
    
    $statement = $db->prepare($query);

    foreach ($data as $key => $value) {
        $statement->bindValue(':' . $key, $value);
    }

    $statement->execute();
    return $db->lastInsertId();

}

function db_update($table, $data, $where) {
    global $db;

    $query = "UPDATE $table SET " . array_to_sql_params($data) . " WHERE " . array_to_sql_params($where);

    $statement = $db->prepare($query);

    foreach (array_merge($data, $where) as $key => $value) {
        $statement->bindValue(':' . $key, $value);
    }

    return $statement->execute();
}

function db_delete($table, $where) {
    global $db;
    
    $query = "DELETE FROM " . $table . " WHERE " . array_to_sql_params($where);
    
    $statement = $db->prepare($query);
    
    foreach ($where as $key => $value) {
        $statement->bindParam(':' . $key, $value);
    }

    return $statement->execute();
}

function array_to_sql_params($array) {
    $params = [];

    foreach ($array as $key => $value) {
        $params[] = "$key=:$key";
    }

    return implode(",", $params);
}

function delete_keys_from_array($array, $keys) {
    foreach ($keys as $key) {
        unset($array[$key]);
    }

    return $array;
}

function add_user_message($type, $text) {
    if (empty($_SESSION['messages'])) {
        $_SESSION['messages'] = [];
    }
    
    $_SESSION['messages'][] = compact('type', 'text');
}

function add_report($type, $title, $text, $additional_text) {
    if (empty($_SESSION['report'])) {
        $_SESSION['report'] = [];
    }
    
    $_SESSION['report'][] = compact('type', 'title', 'text', 'additional_text');
}
