<?php
// Leer los datos del archivo "inglotes.json"
$jsonData = file_get_contents("./JSON/ingalmacenes.json");
$data = json_decode($jsonData, true);

// Conectar a la base de datos
include 'conexion.php';

// Insertar los datos en la tabla "Almacen"
$sql = "INSERT INTO almacen (nombre, direccion, cuidad)
VALUES ('" . $data["nombre"] . "', '" . $data["direccion"] . "', '" . $data["ciudad"] . "')";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>