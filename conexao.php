<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "envios";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>