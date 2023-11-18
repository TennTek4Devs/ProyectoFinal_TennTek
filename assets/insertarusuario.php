<?php
// Decodificar la cadena JSON en un array PHP
$json = file_get_contents('./JSON/ingusuario.json');
$data = json_decode($json, true);

include 'conexion.php';

// Recorrer los elementos del array $usuario y enviarlos a la base de datos con un insert
foreach ($data as $row) {
  $usuario = $row['usuario'];
  $ci = $row['cedula'];
  $contrasena = $row['contrasena'];
  $nombre = $row['nombre'];
  $apellido = $row['apellido'];
  $edad = $row['edad'];
  $email = $row['email'];
  $telefono = $row['telefono'];
  $tipo = $row['tipo'];

  // Crear la consulta SQL con los valores correspondientes
  $sql = "INSERT INTO usuario (usuario, ci, contrasena, nombre, apellido, edad, email, telefono, tipo, rut) VALUES ('$usuario', '$ci', '$contrasena', '$nombre', '$apellido', '$edad', '$email', '$telefono', '$tipo', '')";

  // Ejecutar la consulta SQL utilizando la función mysqli_query()
  if (mysqli_query($conn, $sql)) {

        // Consulta SQL
    $sql2 = "SELECT id_user FROM usuario WHERE usuario = '$usuario'";

    // Ejecuta la consulta y obtiene el resultado
    $result = $conn->query($sql2);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
      // Obtiene el resultado
      $row2 = $result->fetch_assoc();
      $id_userCL = $row2["id_user"];
      
      // Crear la consulta SQL con los valores correspondientes
      $sql3 = "INSERT INTO cliente (id_user) VALUES ('$id_userCL')";

      // Ejecutar la consulta SQL utilizando la función mysqli_query()
      if (mysqli_query($conn, $sql3)) {
        echo "Usuario ingresado";
    } else {
      $error_message2 = "'Error al insertar datos: ' . mysqli_error($conn) . '<br>'";
    }

    } else {
      $error_message3 = "No se encontraron resultados.";
    }

  } else {
    $error_message1 = "'Error al insertar datos: ' . mysqli_error($conn) . '<br>'";
  }

  

}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>