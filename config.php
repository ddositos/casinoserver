<?php

class Database{
	private $pdo = null;
	function __construct(){
		$host = 'remotemysql.com:3306';
		$db = 'HuV3wK2vrx';
		$username = 'HuV3wK2vrx';
		$password = '0rUY2FTmY6';
		$this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $password);
	}
	function user_create($nickname){
		$statement = $this->pdo->prepare("SELECT FROM users id WHERE nickname = ?");
		$statement->execute($nickname);
		var_dump($statement->fetch(PDO::FETCH_LAZY));
	}
}



define("TOKEN", "pank228");
