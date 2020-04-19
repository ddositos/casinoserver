<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

$nickname = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

if($nickname === null || $token === null)
	exit(0);

require_once(ROOT . 'config.php');

$db = new Database();
$db->user_create($nickname);
