<?php
session_start();
include "db.php";

if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users VALUES (NULL, '$name', '$email', '$password')");
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $res->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Wrong email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login / Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2 class="text-center mb-4">School App</h2>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <div class="row">
      
        <div class="col-md-6">
            <h3>Sign Up</h3>
            <form method="POST">
                <input class="form-control mb-2" name="name" placeholder="Full Name" required>
                <input class="form-control mb-2" name="email" type="email" placeholder="Email Address" required>
                <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
                <button class="btn btn-primary w-100" name="register">Sign Up</button>
            </form>
        </div>


        <div class="col-md-6">
            <h3>Login</h3>
            <form method="POST">
                <input class="form-control mb-2" name="email" type="email" placeholder="Email Address" required>
                <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
                <button class="btn btn-primary w-100" name="login">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
