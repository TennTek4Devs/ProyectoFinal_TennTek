<?php
// Conectar a la base de datos
include 'conexion.php';

// Seleccionar todas las filas de la tabla "lotes"
$sql = "SELECT * FROM lotes";
$result = $conn->query($sql);

// Crear un array vacío para almacenar las filas
$rows = array();

// Agregar cada fila al array
while($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Convertir el array en un objeto JSON
$json = json_encode($rows);

file_put_contents('./JSON/lotes.json', $json);


?>