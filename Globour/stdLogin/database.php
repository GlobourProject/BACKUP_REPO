<?php

$server = 'localhost';
$username = 'root';
$password = '33245994Licensie1';
$database = 'users';

try
{
	$conn=new PDO("mysql:host=$server; dbname=$database;", $username, $password);
}
catch(PDOException $ex)
{
	die("Connection failed: " . $ex->getMessage());
}
?>