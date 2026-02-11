<?php
require_once __DIR__ . '/../../app/middleware/auth.php';
?>

<?php
header("Content-Type: application/json");
require_once "../../app/config/database.php";

// Get JSON from IoT device
$data = json_decode(file_get_contents("php://input"), true);

$helmet_uid = $data['helmet_uid'] ?? '';
$alcohol_level = $data['alcohol_level'] ?? '';
$latitude = $data['latitude'] ?? null;
$longitude = $data['longitude'] ?? null;

// Basic validation
if (empty($helmet_uid) || empty($alcohol_level)) {
    echo json_encode([
        "status" => false,
        "message" => "Helmet UID and alcohol level are required"
    ]);
    exit;
}

// Check if helmet exists
$stmt = $pdo->prepare("SELECT * FROM helmets WHERE helmet_uid = ?");
$stmt->execute([$helmet_uid]);
$helmet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$helmet) {
    echo json_encode([
        "status" => false,
        "message" => "Helmet UID not found"
    ]);
    exit;
}

// Insert incident
$stmt = $pdo->prepare(
    "INSERT INTO incidents (helmet_uid, alcohol_level, latitude, longitude)
     VALUES (?, ?, ?, ?)"
);
$stmt->execute([$helmet_uid, $alcohol_level, $latitude, $longitude]);

echo json_encode([
    "status" => true,
    "message" => "Alcohol incident recorded",
    "incident" => [
        "helmet_uid" => $helmet_uid,
        "owner_name" => $helmet['owner_name'],
        "phone_number" => $helmet['phone_number'],
        "alcohol_level" => $alcohol_level,
        "latitude" => $latitude,
        "longitude" => $longitude,
        "detected_at" => date("Y-m-d H:i:s")
    ]
]);
