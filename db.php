<?php
$host = "localhost";
$user = "root";
$pass = ""; // ถ้า XAMPP ไม่ได้ตั้งรหัส ให้เว้นว่าง
$dbname = "keyboard_store";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>

