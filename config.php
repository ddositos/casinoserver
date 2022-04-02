<?php

class Database{
	private $pdo = null;
	function __construct(){
		// Данные бд, которые можно найти в коммитах уже, не актуальны.
		$host = 'host';
		$db = 'table';
		$username = 'username';
		$password = 'password';
		$this->pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $password);
	}
	function log($line){
		$file = fopen($_SERVER['DOCUMENT_ROOT'] . "/logs.txt", "a");
		fwrite($file, $line . "\n");
		fclose($file);
	}
	function user_create($nickname){
		if(!$this->user_exists($nickname)){
			$statement = $this->pdo->prepare("INSERT INTO users (nickname, balance) VALUES (?, 0)");
			$statement->execute([$nickname]);
			return "True";
		}
		return "False";
	}
	function user_get($nickname){
		$statement = $this->pdo->prepare("SELECT balance FROM users WHERE nickname = ? LIMIT 1");
		$statement->execute([$nickname]);
		$result = $statement->fetch(PDO::FETCH_LAZY);
		if($result === false)
			return 0;
		return $result['balance'];
	}
	function user_exists($nickname){
		$statement = $this->pdo->prepare("SELECT 1 FROM users WHERE nickname = ? LIMIT 1");
		$statement->execute([$nickname]);
		return ($statement->fetch(PDO::FETCH_LAZY) === false) ? false : true;
	}
	function user_pay($nickname, $delta){
		$this->log("$nickname pay $delta");
		if(!$this->user_exists($nickname)){
			if($delta < 0)
				return "False";
			return $this->user_set($nickname, $delta);
		}
		$balance = $this->user_get($nickname);
		$balance += $delta;
		if($balance < 0)
			return "False";
		$statement = $this->pdo->prepare("UPDATE users SET balance = ? WHERE nickname = ?");
		$statement->execute([
			$balance,
			$nickname
		]);
		
		return "True";
	}
	function user_set($nickname, $balance){
		if(!$this->user_exists($nickname)){
			$statement = $this->pdo->prepare("INSERT INTO users (nickname, balance) VALUES (:nickname, :balance)");
			$statement->bindValue(":nickname", $nickname, PDO::PARAM_STR);
			$statement->bindValue(":balance", $balance, PDO::PARAM_INT);
			$statement->execute();
		}
		else {
			$statement = $this->pdo->prepare("UPDATE users SET balance = :balance WHERE nickname = :nickname");
			$statement->bindValue(":nickname", $nickname, PDO::PARAM_STR);
			$statement->bindValue("balance", $balance, PDO::PARAM_INT);
			$statement->execute();
		}
		return "True";
	}
	function user_delete($nickname){
		$statement = $this->pdo->prepare("DELETE FROM users WHERE nickname = :nickname");
		$statement->bindValue(":nickname", $nickname, PDO::PARAM_STR);
		$statement->execute();
		return "True";
	}
	function get_top($count = 5){
		$statement = $this->pdo->prepare("SELECT nickname, balance FROM users ORDER BY balance DESC LIMIT :limit");
		$statement->bindValue(":limit", $count, PDO::PARAM_INT);
		$statement->execute();
		$response = "";
		while($row = $statement->fetch(PDO::FETCH_LAZY)){
			$response .= $row['nickname'] . ': ' . $row['balance'] . " коинов\n";
		}
		return $response;
	}
}

define("TOKEN", "pank228");
