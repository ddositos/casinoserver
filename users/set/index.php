<?php
header("HTTP/1.1 200 OK");
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
require_once(ROOT . 'config.php');

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
$nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
$balance = filter_input(INPUT_POST, 'balance', FILTER_SANITIZE_NUMBER_INT);

if($nickname === null ||  $balance === null || $token !== TOKEN)
	exit("False");

$db = new Database();
echo $db->user_set($nickname, $balance);

