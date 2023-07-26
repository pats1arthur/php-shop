<?php

$isAdmin = ($_SERVER['PHP_AUTH_USER'] ?? '') == ADMIN_LOGIN && ($_SERVER['PHP_AUTH_PW'] ?? '') == ADMIN_PASSWORD;

if (!$isAdmin) {
    header("WWW-Authenticate: Basic realm=\"Admin area\"");
    die("Доступ заборонено");
}
