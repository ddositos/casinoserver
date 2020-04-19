<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

$nickname = filter_input("GET", 'name', FILTER_SANITIZE_STRING);
$token = filter_input("GET", 'token', FILTER_SANITIZE_STRING);
echo $nickname . ' ' . $token;
