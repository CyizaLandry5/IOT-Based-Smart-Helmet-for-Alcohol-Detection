<?php
require_once __DIR__ . '/../app/middleware/auth.php';
?>

<?php include "layout/header.php"; ?>
<a href="dashboard.php"><button>Back</button></a>
<h2>Live Cases</h2>
<p>Click a helmet circle to see alcohol detection details.</p>

<div id="helmetsContainer" style="display:flex; flex-wrap: wrap; gap: 15px; margin-top:20px;"></div>

<h3>Map</h3>
<div id="map" style="width:100%; height:500px; border-radius:12px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
<script src="../public/js/maps.js"></script>
<script src="../public/js/live_cases.js"></script>

<?php include "layout/footer.php"; ?>
