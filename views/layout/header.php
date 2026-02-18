<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IOT Based Smart Helmet for Alcohol Detection</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body style="margin:0; padding-top:100px; padding-bottom:60px;">

<header style="background:#007bff;color:#fff;
               padding:20px 25px;
               position:fixed; top:0; left:0; width:100%;
               z-index:1000;
               display:flex;
               align-items:center;
               justify-content:space-between;
               box-sizing:border-box;">

    <!-- Title -->
    <h1 style="margin:0; font-size:22px;">
        IOT Based Smart Helmet for Alcohol Detection
    </h1>

    <!-- Profile / Logout -->
    <div style="position:relative; display:flex; align-items:center;">

        <!-- Avatar frame -->
        <div onclick="toggleMenu()"
             style="width:44px; height:44px;
                    border-radius:50%;
                    overflow:hidden;
                    border:2px solid #f1eeee;
                    cursor:pointer;
                    flex-shrink:0;">

            <img src="../public/images/michel.png"
                 style="width:100%;
                        height:100%;
                        object-fit:cover;
                        display:block;">
        </div>

        <!-- Dropdown -->
        <div id="profileMenu"
             style="display:none;
                    position:absolute;
                    right:0;
                    top:55px;
                    background:#fff;
                    color:#000;
                    min-width:160px;
                    box-shadow:0 4px 8px rgba(0,0,0,0.2);
                    border-radius:6px;
                    overflow:hidden;">

            <div style="padding:10px; color:#999; cursor:not-allowed;">
                Settings (coming soon)
            </div>

            <hr style="margin:0;">

            <a href="../logout.php"
               style="display:block;
                      padding:10px;
                      text-decoration:none;
                      color:#000;">
                🚪 Logout
            </a>
        </div>
    </div>
</header>

<main style="padding:20px;">

<script>
    function toggleMenu() {
        var menu = document.getElementById("profileMenu");
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    document.addEventListener("click", function(e) {
        if (!e.target.closest("header")) {
            var menu = document.getElementById("profileMenu");
            if (menu) menu.style.display = "none";
        }
    });
</script>
