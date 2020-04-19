<?php
function connect(){
	$host = 'remotemysql.com:3306';
	$db = 'HuV3wK2vrx';
	$username = 'HuV3wK2vrx';
	$password = '0rUY2FTmY6';
	return new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $password);
}


define("TOKEN", "pank228");
