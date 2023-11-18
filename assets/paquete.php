<?php
// Establecer la conexión con la base de datos
include 'conexion.php';

// Obtener los datos de la tabla paquete
$sql = "SELECT * FROM paquete";
$result = $conn->query($sql);

// Crear un array con los datos de la tabla
$paquetes = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $paquetes[] = $row;
  }
}

// Convertir el array a formato JSON
$json = json_encode($paquetes);

// Guardar los datos en un archivo JSON
$file = './JSON/paquetes.json';
file_put_contents($file, $json);

// Cerrar la conexión
$conn->close();
?>