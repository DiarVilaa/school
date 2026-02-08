<?php
session_start();
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: index.php");
$uid = $_SESSION['user_id'];

if(isset($_POST['shto'])){
    $dita = $_POST['dita'];
    $pershkrimi = $_POST['pershkrimi'];
    $conn->query("INSERT INTO ditari VALUES(NULL,$uid,'$dita','$pershkrimi')");
}
$res = $conn->query("SELECT * FROM ditari WHERE user_id=$uid");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Ditari</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
        <a href="ditari.php">Diary</a>
        <a href="notat.php">Grades</a>
        <a href="faleminderit.php">Thank you</a>
        <a href="logout.php">Logout</a> 
</div>

<div class="card">
<h2>My Diary</h2>
<form method="POST">
<input class="form-control mb-2" name="dita" placeholder="Data / Day">
<textarea class="form-control mb-2" name="pershkrimi" placeholder="TEXT"></textarea>
<button class="btn btn-primary" name="shto">Add Note</button>
</form>

<hr>
<h3>Existing notes</h3>
<?php while($r = $res->fetch_assoc()): ?>
<p><b><?= $r['dita'] ?>:</b> <?= $r['pershkrimi'] ?></p>
<?php endwhile; ?>
</div>
</body>
</html>
