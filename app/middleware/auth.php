<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if (!isset($_SESSION['user_id'])) {
    header("Location: /HELMET_V3/IOT-Based-Smart-Helmet-for-Alcohol-Detection/public/index.php");
    exit();
}
