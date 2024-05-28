<?php
$servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}
?>
