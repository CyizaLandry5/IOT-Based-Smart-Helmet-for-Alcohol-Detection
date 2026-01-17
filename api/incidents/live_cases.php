<?php
header("Content-Type: application/json");
require_once "../../app/config/database.php";

// Get incidents in the last 1 hour (live cases)
$stmt = $pdo->query("
    SELECT i.*, h.owner_name, h.phone_number
    FROM incidents i
    JOIN helmets h ON i.helmet_uid = h.helmet_uid
    WHERE i.detected_at >= NOW() - INTERVAL 1 HOUR
    ORDER BY i.detected_at DESC
");

$incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => true,
    "data" => $incidents
]);
