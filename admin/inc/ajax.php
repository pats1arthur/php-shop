<?php


require 'functions.php';

$action = $_GET['action'];

if ($action === "categories/insert") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    insert_category_into_db($id, $name);
}
else if ($action === "categories/update") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    update_category_in_db($id, $name);
}
else if ($action === "categories/delete") {
    $id = $_POST['id'];
    delete_row_from_db('categories', $id);
    
}
