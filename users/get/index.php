<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

$nickname = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

var_dump($token);
