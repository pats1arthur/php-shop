<?php

$isAdmin = ($_SERVER['PHP_AUTH_USER'] ?? '') == 'artur' && ($_SERVER['PHP_AUTH_PW'] ?? '') == '12345';

if (!$isAdmin) {
    header("WWW-Authenticate: Basic realm=\"Admin area\"");
    die("Доступ заборонено");
}
