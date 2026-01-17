<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: ../views/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Helmet Login</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { display:flex; justify-content:center; align-items:center; height:100vh; background:#f0f2f5; }
        .login-box { background:#fff; padding:30px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.2); width:100%; max-width:400px; }
        .login-box h2 { text-align:center; margin-bottom:20px; }
        .login-box input { width:100%; padding:12px; margin:8px 0; border-radius:6px; border:1px solid #ccc; }
        .login-box button { width:100%; padding:12px; border:none; border-radius:6px; background:#007bff; color:#fff; font-size:16px; cursor:pointer; }
        .login-box button:hover { background:#0056b3; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login</h2>
    <form id="loginForm">
        <input type="text" id="username" placeholder="Username" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

<script>
const form = document.getElementById("loginForm");

form.addEventListener("submit", e => {
    e.preventDefault();

    const payload = {
        username: document.getElementById("username").value,
        password: document.getElementById("password").value
    };

    fetch("../api/auth/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        if(data.status){
            alert(data.message);
            window.location.href = "../views/dashboard.php";
        } else {
            alert(data.message);
        }
    });
});
</script>
</body>
</html>
