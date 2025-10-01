<?php
include 'config.php';

// Users (login + roles)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','agent','client') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Agents
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS agents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    phone VARCHAR(50),
    email VARCHAR(150) UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(id)
)");

// Clients
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(50),
    email VARCHAR(150) UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users(id)
)");

// Regions
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS regions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
)");

// Property Types
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS property_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
)");

// Properties
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_id INT NOT NULL,
    region_id INT NOT NULL,
    agent_id INT NOT NULL,
    address VARCHAR(200) NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price > 0),
    area DECIMAL(10,2) NOT NULL CHECK (area > 0),
    rooms INT NOT NULL,
    status ENUM('available','reserved','sold','withdrawn') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (type_id) REFERENCES property_types(id),
    FOREIGN KEY (region_id) REFERENCES regions(id),
    FOREIGN KEY (agent_id) REFERENCES agents(id)
)");

// Viewings
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS viewings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    agent_id INT NOT NULL,
    client_id INT NOT NULL,
    scheduled_on DATETIME NOT NULL,
    result VARCHAR(255),
    FOREIGN KEY (property_id) REFERENCES properties(id),
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (client_id) REFERENCES clients(id)
)");

// Offers (deals)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS offers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    agent_id INT NOT NULL,
    client_id INT NOT NULL,
    signed_on DATE NOT NULL,
    price DECIMAL(12,2) NOT NULL CHECK(price > 0),
    FOREIGN KEY (property_id) REFERENCES properties(id),
    FOREIGN KEY (agent_id) REFERENCES agents(id),
    FOREIGN KEY (client_id) REFERENCES clients(id)
)");

// Property Photos
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS property_photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    path VARCHAR(255) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id)
)");

// Notes
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL,
    author_id INT NOT NULL,
    text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (property_id) REFERENCES properties(id),
    FOREIGN KEY (author_id) REFERENCES users(id)
)");

// Audit logs
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(100) NOT NULL,
    entity VARCHAR(100) NOT NULL,
    entity_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)");
?>
