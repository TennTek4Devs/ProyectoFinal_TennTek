<?php

// Ruta del archivo JSON
$jsonFile = "./JSON/ingusuario.json";

// Leer el contenido del archivo JSON
$jsonData = file_get_contents($jsonFile);

// Decodificar el JSON en un array asociativo
$data = json_decode($jsonData, true);

// Obtener los valores del JSON
$usuario = $data[0]['usuario'];
$rut = $data[0]['rut'];
$nombre = $data[0]['nombre'];
$email = $data[0]['email'];
$tipo = $data[0]['tipo'];
$telefono = $data[0]['telefono'];
$contrasena = $data[0]['contrasena'];

// Conexión a la base de datos
include "conexion.php";

// Sentencia de inserción
$sql = "INSERT INTO usuario (usuario, ci, contrasena, nombre, apellido, edad, email, telefono, tipo, rut)
        VALUES ('$usuario', NULL, '$contrasena', '$nombre', NULL, NULL, '$email', '$telefono', '$tipo', '$rut')";

// Ejecutar la sentencia de inserción
if ($conn->query($sql) === TRUE) {
    
    include 'usuarios.php';

    // Cargar el contenido del archivo JSON
    $jsonData3 = file_get_contents('./JSON/usuarios.json');

    // Decodificar el JSON en un array asociativo
    $usuariosArray = json_decode($jsonData3, true);
    global $usuario;

    foreach ($usuariosArray as $usuario5) {
        if ($usuario5['usuario'] === $usuario) {
            // Si se encuentra, obtener el id_user
            $idUsuarioEncontrado = $usuario5['id_user'];
            break; // Terminar el bucle una vez encontrado
        }
    }

    global $idUsuarioEncontrado;
    $sql2 = "INSERT INTO empresa (id_user) VALUES ('$idUsuarioEncontrado')";
    if ($conn->query($sql2) === TRUE) {

    }else{

    }
} else {
    
}

// Cerrar la conexión a la base de datos
$conn->close();

?>