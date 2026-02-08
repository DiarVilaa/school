<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard - Shkolla Vëllezërit Frashëri</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>


<div class="navbar">
    <div class="d-flex align-items-center">
        <img src="logo.png" alt="Logo Shkolla Vëllezërit Frashëri">
        <h3 class="ms-3 mb-0">Vëllezërit Frashëri School  - Lipjan</h3>
    </div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="ditari.php">Diary</a>
        <a href="notat.php">Grades</a>
        <a href="faleminderit.php">Thank you</a>
        <a href="logout.php">Logout</a>
    </div>
</div>


<div class="card text-center" >
    <img class="dashboard-img" src="foto.jpg" alt="Foto e Shkollës" >
    <h2>Welcome to the School App</h2>
    <p>Use the menu above to access your diary, grades, and other information.
</div>


<div class="footer">
    &copy; 2026 Vëllezërit Frashëri School - Lipjan | All rights reserved

</body>
</html>
