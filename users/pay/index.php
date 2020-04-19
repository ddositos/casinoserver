<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
require_once(ROOT . 'config.php');

$nickname = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
$delta = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_NUMBER_INT);

if($nickname === null || $token === null || $delta === null || $token !== TOKEN)
	exit("False");

$db = new Database();
echo $db->user_pay($nickname, -$delta);

