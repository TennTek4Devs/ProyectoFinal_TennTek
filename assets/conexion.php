<?php

$servername = "192.168.5.50";
$username = "salvador.pereira";
$password = "56468474";
$dbname = "tenntek";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

?>