<?php
$conn = new mysqli("localhost", "root", "", "school_app");

if ($conn->connect_error) {
    die("Lidhja deshtoi");
}
?>
