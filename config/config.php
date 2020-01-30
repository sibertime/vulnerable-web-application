<?php

#mysqli bağlantısı
$con = new mysqli("localhost", "root", "", "egitim");
$charset = $con->character_set_name();
error_reporting(0);

#Pdo bağlantısı
$host = "localhost";
$username = "root";
$password = "";
$database = "egitim";

$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
