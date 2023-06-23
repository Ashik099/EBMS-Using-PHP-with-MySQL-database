<?php
	$dbhost = "localhost";
	$dbname = "ebms";
	$dbuser = "root";
	$dbpassword = "";

	try{
		$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Conncetion Error: ".$e->getMessage();
	}
?>