<?php
require_once __DIR__ . '/../app/middleware/auth.php';
?>

<?php include "layout/header.php"; ?>
<a href="dashboard.php"><button>Back</button></a>


<center><h2>Helmet Registration</h2></center>

<form id="helmetForm">
    <input type="text" placeholder="Helmet ID (e.g HELM-001)" id="helmet_uid" required>
    <input type="text" placeholder="Owner Name" id="owner_name" required>
    <input type="text" placeholder="Phone Number" id="phone_number" required>
    <button type="submit">Register Helmet</button>
</form>

<hr>

<h3>Registered Helmets</h3>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Helmet ID</th>
            <th>Owner</th>
            <th>Phone</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody id="helmetTable"></tbody>
</table>

<script src="../public/js/helmets.js"></script>

<?php include "layout/footer.php"; ?>
