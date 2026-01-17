<?php
header("Content-Type: application/json");
require_once "../../app/config/database.php";

$data = json_decode(file_get_contents("php://input"), true);

$helmet_uid   = $data['helmet_uid'] ?? '';
$owner_name   = $data['owner_name'] ?? '';
$phone_number = $data['phone_number'] ?? '';

if (empty($helmet_uid) || empty($owner_name) || empty($phone_number)) {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO helmets (helmet_uid, owner_name, phone_number)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$helmet_uid, $owner_name, $phone_number]);

    echo json_encode([
        "status" => true,
        "message" => "Helmet registered successfully"
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => false,
        "message" => "Helmet ID already exists"
    ]);
}
