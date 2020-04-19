<?php
header("HTTP/1.1 200 OK");
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
require_once(ROOT . 'config.php');


$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

if($token !== TOKEN)
	exit("-");

$db = new Database();
echo $db->get_top(5);

