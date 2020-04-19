<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
require_once(ROOT . 'config.php');

$nickname = filter_input(INPUT_GET, 'nickname', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

if($nickname === null || $token === null || $token !== TOKEN)
	exit(0);

$db = new Database();
echo $db->user_get($nickname);
