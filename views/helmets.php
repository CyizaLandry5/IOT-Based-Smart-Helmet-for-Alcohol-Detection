<?php
require_once __DIR__ . '/../app/middleware/auth.php';
require_once __DIR__ . '/../app/config/database.php';

include "layout/header.php";

/* Fetch ACTIVE helmets only */
$stmt = $pdo->prepare("SELECT * FROM helmets WHERE status='active' ORDER BY created_at DESC");
$stmt->execute();
$helmets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<a href="dashboard.php"><button>Back</button></a>

<center><h2>Helmet Registration</h2></center>

<!-- Registration Form -->
<form method="POST" action="">
    <input type="text" name="helmet_uid" placeholder="Helmet ID (e.g HELM-001)" required>

    <input type="text" name="plate_number" 
           placeholder="Plate Number (RA 123 A)" 
           pattern="^RA\s[0-9]{3}\s[A-Z]$"
           title="Format must be RA 123 A"
           required>

    <input type="text" name="owner_name" placeholder="Owner Name" required>

    <input type="text" name="phone_number" 
           placeholder="+2507XXXXXXXX" 
           pattern="^\+[0-9]{10,15}$"
           title="Enter valid international phone number starting with +"
           required>

    <button type="submit" name="register">Register Helmet</button>
</form>

<?php
/* Handle Registration */
if (isset($_POST['register'])) {

    $helmet_uid = $_POST['helmet_uid'];
    $plate_number = strtoupper($_POST['plate_number']);
    $owner_name = $_POST['owner_name'];
    $phone_number = $_POST['phone_number'];

    $insert = $pdo->prepare("INSERT INTO helmets 
        (helmet_uid, plate_number, owner_name, phone_number) 
        VALUES (?, ?, ?, ?)");

    $insert->execute([$helmet_uid, $plate_number, $owner_name, $phone_number]);

    echo "<script>window.location='helmets.php';</script>";
}
?>

<hr>

<h3>Search Helmets</h3>
<input type="text" id="searchInput" placeholder="Search by Helmet ID, Plate, Owner...">

<button onclick="printTable()">Print Searched Results</button>

<br><br>

<div style="max-height:400px; overflow-y:auto;">
<table border="1" width="100%" id="helmetTable">
    <thead>
        <tr>
            <th>Helmet ID</th>
            <th>Plate</th>
            <th>Owner</th>
            <th>Phone</th>
            <th>Registered At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($helmets as $helmet): ?>
        <tr>
            <td><?= htmlspecialchars($helmet['helmet_uid']) ?></td>
            <td><?= htmlspecialchars($helmet['plate_number']) ?></td>
            <td><?= htmlspecialchars($helmet['owner_name']) ?></td>
            <td><?= htmlspecialchars($helmet['phone_number']) ?></td>
            <td><?= $helmet['created_at'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="disable_id" value="<?= $helmet['id'] ?>">
                    <button type="submit">Disable</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php
/* Handle Disable */
if (isset($_POST['disable_id'])) {

    $id = $_POST['disable_id'];

    $update = $pdo->prepare("UPDATE helmets SET status='inactive' WHERE id=?");
    $update->execute([$id]);

    echo "<script>window.location='helmets.php';</script>";
}
?>

<script>

/* SEARCH FUNCTION */
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#helmetTable tbody tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
    });
});

/* PRINT SEARCHED RESULTS ONLY */
function printTable() {
    let table = document.getElementById("helmetTable").outerHTML;
    let newWin = window.open("");
    newWin.document.write("<h2>Helmet List</h2>");
    newWin.document.write(table);
    newWin.print();
    newWin.close();
}

</script>

<?php include "layout/footer.php"; ?>
