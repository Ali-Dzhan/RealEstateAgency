<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';

$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die('Cannot connect to MySQL server: ' . mysqli_connect_error());
}
?>