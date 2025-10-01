<?php
include 'config.php';

// function to hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// USERS
$users = [
    ['username' => 'admin1', 'password' => 'adminpass', 'role' => 'admin'],
    ['username' => 'agent1', 'password' => 'agentpass', 'role' => 'agent'],
    ['username' => 'agent2', 'password' => 'agentpass', 'role' => 'agent'],
    ['username' => 'client1', 'password' => 'clientpass', 'role' => 'client'],
    ['username' => 'client2', 'password' => 'clientpass', 'role' => 'client'],
];

foreach ($users as $user) {
    $password_hash = hashPassword($user['password']);
    mysqli_query($conn, "INSERT INTO users (username, password_hash, role) VALUES (
        '{$user['username']}', '$password_hash', '{$user['role']}'
    )");
}

// Get user IDs
$user_ids = [];
$res = mysqli_query($conn, "SELECT id, username FROM users");
while ($row = mysqli_fetch_assoc($res)) {
    $user_ids[$row['username']] = $row['id'];
}

// AGENTS
$agents = [
    ['user_id' => $user_ids['agent1'], 'first_name' => 'Иван', 'last_name' => 'Петров', 'phone' => '+359888123456', 'email' => 'ivan.petrov@example.com'],
    ['user_id' => $user_ids['agent2'], 'first_name' => 'Мария', 'last_name' => 'Димитрова', 'phone' => '+359888654321', 'email' => 'maria.dimitrova@example.com'],
];

foreach ($agents as $agent) {
    mysqli_query($conn, "INSERT INTO agents (user_id, first_name, last_name, phone, email) VALUES (
        {$agent['user_id']}, '{$agent['first_name']}', '{$agent['last_name']}', '{$agent['phone']}', '{$agent['email']}'
    )");
}

// Map agent names to IDs
$agents_map = [];
$res = mysqli_query($conn, "SELECT id, first_name FROM agents");
while ($row = mysqli_fetch_assoc($res)) {
    $agents_map[$row['first_name']] = $row['id'];
}

// CLIENTS
$clients = [
    ['user_id' => $user_ids['client1'], 'name' => 'Георги Иванов', 'phone' => '+359887112233', 'email' => 'georgi.ivanov@example.com'],
    ['user_id' => $user_ids['client2'], 'name' => 'Елена Николова', 'phone' => '+359887445566', 'email' => 'elena.nikolova@example.com'],
];

foreach ($clients as $client) {
    mysqli_query($conn, "INSERT INTO clients (user_id, name, phone, email) VALUES (
        {$client['user_id']}, '{$client['name']}', '{$client['phone']}', '{$client['email']}'
    )");
}

// Map client names to IDs
$clients_map = [];
$res = mysqli_query($conn, "SELECT id, name FROM clients");
while ($row = mysqli_fetch_assoc($res)) {
    $clients_map[$row['name']] = $row['id'];
}

// REGIONS
$regions = ['София', 'Пловдив', 'Варна', 'Бургас', 'Русе'];
foreach ($regions as $region) {
    mysqli_query($conn, "INSERT INTO regions (name) VALUES ('$region')");
}

// Map regions to IDs
$regions_map = [];
$res = mysqli_query($conn, "SELECT id, name FROM regions");
while ($row = mysqli_fetch_assoc($res)) {
    $regions_map[$row['name']] = $row['id'];
}

// PROPERTY TYPES
$property_types = ['Апартамент', 'Къща', 'Мезонет', 'Таван', 'Парцел'];
foreach ($property_types as $type) {
    mysqli_query($conn, "INSERT INTO property_types (name) VALUES ('$type')");
}

// Map property types to IDs
$property_types_map = [];
$res = mysqli_query($conn, "SELECT id, name FROM property_types");
while ($row = mysqli_fetch_assoc($res)) {
    $property_types_map[$row['name']] = $row['id'];
}

// PROPERTIES
$properties = [
    ['type' => 'Апартамент', 'region' => 'София', 'agent' => 'Иван', 'address' => 'ул. Васил Левски 12', 'price' => 120000, 'area' => 85.5, 'rooms' => 3, 'status' => 'available'],
    ['type' => 'Къща', 'region' => 'Варна', 'agent' => 'Мария', 'address' => 'ул. Приморска 45', 'price' => 250000, 'area' => 200, 'rooms' => 5, 'status' => 'available'],
];

foreach ($properties as $prop) {
    mysqli_query($conn, "INSERT INTO properties (type_id, region_id, agent_id, address, price, area, rooms, status) VALUES (
        {$property_types_map[$prop['type']]},
        {$regions_map[$prop['region']]},
        {$agents_map[$prop['agent']]},
        '{$prop['address']}',
        {$prop['price']},
        {$prop['area']},
        {$prop['rooms']},
        '{$prop['status']}'
    )");
}

// Map properties by ID
$properties_map = [];
$res = mysqli_query($conn, "SELECT id, address FROM properties");
while ($row = mysqli_fetch_assoc($res)) {
    $properties_map[$row['address']] = $row['id'];
}

// VIEWINGS
$viewings = [
    ['property_id' => $properties_map['ул. Васил Левски 12'], 'agent_id' => $agents_map['Иван'], 'client_id' => $clients_map['Георги Иванов'], 'scheduled_on' => '2025-10-05 10:00:00', 'result' => 'Интерес проявен'],
    ['property_id' => $properties_map['ул. Приморска 45'], 'agent_id' => $agents_map['Мария'], 'client_id' => $clients_map['Елена Николова'], 'scheduled_on' => '2025-10-06 14:00:00', 'result' => 'Не се интересува'],
];

foreach ($viewings as $v) {
    mysqli_query($conn, "INSERT INTO viewings (property_id, agent_id, client_id, scheduled_on, result) VALUES (
        {$v['property_id']},
        {$v['agent_id']},
        {$v['client_id']},
        '{$v['scheduled_on']}',
        '{$v['result']}'
    )");
}

// OFFERS
$offers = [
    ['property_id' => $properties_map['ул. Васил Левски 12'], 'agent_id' => $agents_map['Иван'], 'client_id' => $clients_map['Георги Иванов'], 'signed_on' => '2025-10-10', 'price' => 118000],
];

foreach ($offers as $o) {
    mysqli_query($conn, "INSERT INTO offers (property_id, agent_id, client_id, signed_on, price) VALUES (
        {$o['property_id']},
        {$o['agent_id']},
        {$o['client_id']},
        '{$o['signed_on']}',
        {$o['price']}
    )");
}

echo "Seeding complete!";
?>
