<?php
session_start();
include "db.php";

// Sigurohu që përdoruesi është loguar
if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}

$uid = $_SESSION['user_id'];

// Lista e top 10 lëndëve në Kosovë
$lendet =["Mathematics", "Albanian Language", "English Language", "History", "Biology", "Chemistry", "Physics", "Geography", "Informatics", "Physical Education"];

// Nëse u klikua butoni për shtim/update note
if(isset($_POST['shto'])){
    foreach($_POST['nota'] as $lenda => $nota){
        // Kontrollo nëse ekziston nota për këtë user & lëndë
        $res = $conn->query("SELECT * FROM notat WHERE user_id=$uid AND lenda='$lenda'");
        if($res->num_rows > 0){
            // Update
            $conn->query("UPDATE notat SET nota=$nota WHERE user_id=$uid AND lenda='$lenda'");
        } else {
            // Insert
            $conn->query("INSERT INTO notat VALUES(NULL,$uid,'$lenda',$nota)");
        }
    }
    $msg = "Grades saved successfully!";
}

// Merr notat ekzistuese të këtij përdoruesi
$ekzistues = [];
$res = $conn->query("SELECT * FROM notat WHERE user_id=$uid");
while($r = $res->fetch_assoc()){
    $ekzistues[$r['lenda']] = $r['nota'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Grades</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card { max-width: 800px; margin: 50px auto; padding: 20px; }
.note-select { width: 80px; display: inline-block; }
</style>
</head>
<body>
<div class="card shadow">
    <h2 class="text-center mb-4">My grades</h2>

    <?php if(isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>

    <form method="POST">
        <?php foreach($lendet as $lenda): 
            $nota_value = $ekzistues[$lenda] ?? 1; // default 1
        ?>
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <label><?= $lenda ?></label>
            <select name="nota[<?= $lenda ?>]" class="form-select note-select">
                <?php for($i=1; $i<=5; $i++): ?>
                    <option value="<?= $i ?>" <?= $i==$nota_value?'selected':'' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <?php endforeach; ?>

        <div class="text-center mt-4">
            <button class="btn btn-primary" name="shto">Save Notes</button>
        </div>


    </form> 
    <a href="dashboard.php" class="btn btn-secondary mt-3">
        ⬅ Return to Dashboard
    </a>
</div>

</div>
</body>
</html>
