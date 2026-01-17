<?php

session_start();

header("Content-Type: application/json");
require_once "../../app/config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode([
        "status" => false,
        "message" => "Username and password required"
    ]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || $password !== $user['password']) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid credentials"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "message" => "Login successful",
    "user" => [
        "id" => $user['id'],
        "username" => $user['username']
    ]
]);
