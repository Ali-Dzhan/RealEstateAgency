<?php
include 'config_server.php';

$dbName = 'real_estate_agency';

$createDB = "CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

if (mysqli_query($conn, $createDB)) {
    echo "Database '$dbName' created successfully.";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
?>