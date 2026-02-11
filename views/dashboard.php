<?php
require_once __DIR__ . '/../app/middleware/auth.php';
include "layout/header.php";
?>

<style>
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
}
.card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.2s;
    cursor: pointer;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}
.card h2 { margin: 10px 0; font-size: 1.5rem; }
.card p { color: #555; }
</style>

<div class="dashboard-grid">
    <div class="card" onclick="location.href='helmets.php'">
        <h2>Helmets</h2>
        <p>Register & View all helmets</p>
    </div>

    <div class="card" onclick="location.href='live_cases.php'">
        <h2>Live Cases</h2>
        <p>View real-time alcohol detections</p>
    </div>

    <div class="card" onclick="location.href='reports.php'">
        <h2>Reports</h2>
        <p>See all past incidents</p>
    </div>
</div>

<?php include "layout/footer.php"; ?>
