<?php

$password = 'Pr00filer';

try {
	$conn = new PDO('mysql:host=localhost', 'root', 'Pr00filer');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = 'DROP DATABASE IF EXISTS Pr00filer';
	$conn->exec($sql);
	$sql = 'CREATE DATABASE Pr00filer CHARACTER SET utf8 COLLATE utf8_unicode_ci';
	$conn->exec($sql);
	echo '[+] Database "Pr00filer" created successfully'."\n";

	$conn = new PDO('mysql:host=localhost;dbname=Pr00filer', 'root', 'Pr00filer');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = 'CREATE TABLE USERS (
		username VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL
	)';
	$conn->exec($sql);
	echo '[+] Table "USERS" created successfully'."\n";

	$sql = "INSERT INTO USERS (username, password) VALUES ('Pr00filer', '".password_hash($password, PASSWORD_DEFAULT)."')";
	$conn->exec($sql);
	echo '[+] User "Pr00filer" created successfully'."\n";

} catch(PDOException $e) {
	echo $sql."\n".$e->getMessage()."\n";
}

$conn = null;
