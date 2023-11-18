<?php
// Leer los datos del archivo "inglotes.json"
$jsonData = file_get_contents("./JSON/inglotes.json");
$data = json_decode($jsonData, true);

// Conectar a la base de datos
include 'conexion.php';
include 'lotes.php';

// Insertar los datos en la tabla "lotes"
$sql = "INSERT INTO lotes (nombre, id_almacen, estado)
VALUES ('" . $data["nombre"] . "', NULL, '" . $data["estado"] . "')";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>