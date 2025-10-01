<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbname = 'real_estate_agency';

$conn = new mysqli($host, $user, $password, $dbname);

if(!$conn){
    die('Connection failed: ' . mysqli_connect_error());
}

mysqli_query($conn, 'SET NAMES utf8');
?>