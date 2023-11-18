<?php
// Establecer la conexión con la base de datos
include 'conexion.php';

// Leer el archivo JSON
$jsondata = file_get_contents("./JSON/ingpaquete.json");

// Convertir el contenido JSON en un array de PHP
$data = json_decode($jsondata, true);

// Insertar los valores en la tabla paquete
$sql = "INSERT INTO paquete (id_lote, id_user, ci, nombre, peso, ciudad, direccion, origen, mail, telefono)
VALUES ('" . $data["id_lote"] . "', '" . $data["id_user"] . "', '" . $data["ci"] . "', '" . $data["nombre"] . "', '" . $data["peso"] . "', '" . $data["ciudad"] . "', '" . $data["direccion"] . "', '" . $data["origen"] . "', '" . $data["mail"] . "', '" . $data["telefono"] . "')";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error al insertar los valores: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>