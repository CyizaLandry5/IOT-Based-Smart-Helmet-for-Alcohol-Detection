<?php
require_once __DIR__ . '/../../app/middleware/auth.php';
?>

<?php
header("Content-Type: application/json");
require_once "../../app/config/database.php";

$stmt = $pdo->query("SELECT * FROM helmets ORDER BY created_at DESC");
$helmets = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => true,
    "data" => $helmets
]);
