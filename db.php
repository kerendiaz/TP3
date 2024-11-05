<?php
$servername = "keren.alwaysdata.net";
$username = "keren";
$password = "registro2024";
$dbname = "keren_yoa";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>