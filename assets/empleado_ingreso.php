<?php
// Obtener los datos del archivo JSON
$json_data = file_get_contents('./JSON/ingusuario.json');
$data = json_decode($json_data, true);

// Insertar los datos en la tabla usuario de la base de datos
$id_user = ''; // Generar automáticamente en la base de datos
$usuario = $data['usuario'];
$ci = $data['ci'];
$contrasena = $data['contrasena'];
$nombre = $data['nombre'];
$apellido = $data['apellido'];
$edad = $data['edad'];
$email = $data['email'];
$telefono = $data['telefono'];
$tipo = $data['tipo'];
$funcion = $data['funcion'];
//if($data['funcion'] == "Delivery"){
 //$funcion = "conductorNeta";
//}elseif($data['funcion'] == "Camionero"){
 // $funcion = "conductorMion";
//}elseif($data['funcion'] == "Funcionario"){
 // $funcion = "Funcionario";
//}
$cargo = $data['cargo'];
$estado = "Activo";

include 'conexion.php';

$sql = "INSERT INTO usuario (usuario, ci, contrasena, nombre, apellido, edad, email, telefono, tipo)
        VALUES ('$usuario', '$ci', '$contrasena', '$nombre', '$apellido', '$edad', '$email', '$telefono', '$tipo')";

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

  $sql2 = "INSERT INTO empleado (id_user, funcion, estado) VALUES ('$idUsuarioEncontrado', '$funcion', '$estado')";

  if ($conn->query($sql2) === TRUE) {

    // Insertar los datos en la tabla correspondiente según la función seleccionada
  if ($funcion == 'Funcionario') {
    // Código para insertar los datos en la tabla funcionario
    $sql3 = "INSERT INTO funcionario (id_user, cargo) VALUES ('$idUsuarioEncontrado', '$cargo')";
    if ($conn->query($sql3) === TRUE) {
      echo "Usuario ingresado.";
    }else{
      echo "error 3";
    }

  } elseif ($funcion == 'conductorNeta') {
   // Código para insertar los datos en la tabla conductorneta
    $sql4 = "INSERT INTO conductorNeta (id_user, cargo) VALUES ('$idUsuarioEncontrado', '$cargo')";
    if ($conn->query($sql4) === TRUE) {
      echo "Usuario ingresado.";
    }else{
      echo "error 3";
    }

  } elseif ($funcion == 'conductorMion') {
    // Código para insertar los datos en la tabla conductormion
    $sql5 = "INSERT INTO conductorMion (id_user, cargo) VALUES ('$idUsuarioEncontrado', '$cargo')";
    if ($conn->query($sql5) === TRUE) {
      echo "Usuario ingresado.";
    }else{
      echo "error 3";
    }

}

  }else{
    echo "error 2";
  }

}else{
  echo "error";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>