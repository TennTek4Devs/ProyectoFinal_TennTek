<?php

include './assets/usuarios.php';
// Obtener el contenido del archivo JSON
$json = file_get_contents('./JSON/usuarios.json');

// Decodificar el archivo JSON en un array asociativo
$usuarios = json_decode($json, true);

// Verificar si el usuario ya existe
function verificar_usuario($usuario)
{
  global $usuarios;
  foreach ($usuarios as $u) {
    if ($u['usuario'] === $usuario) {
      return true;
    }
  }
  return false;
}

// Verificar si el correo electrónico ya existe
function verificar_correo($correo)
{
  global $usuarios;
  foreach ($usuarios as $u) {
    if ($u['email'] === $correo) {
      return true;
    }
  }
  return false;
}

// Verificar si los datos no están repetidos
function verificar_datos($usuario, $correo)
{
  if (verificar_usuario($usuario) || verificar_correo($correo)) {
    return false;
  }
  return true;
}

// Obtener los datos del formulario
if (isset($_POST['registrarse_'])) {
  $usuario = $_POST['user'];
  $rut = $_POST['rut'];
  $nombre = $_POST['nombre'];
  $correo = $_POST['email'];
  $telefono = $_POST['telefono'];
  $contragen = $_POST['contrase'];
  // Crear un hash de la contraseña utilizando password_hash()
  $hash = password_hash($contragen, PASSWORD_BCRYPT);

  // Verificar si los datos no están repetidos
  if (verificar_datos($usuario, $correo)) {
    // Crear un nuevo usuario
    $nuevoUsuario = array(
      'usuario' => $usuario,
      'rut' => $rut,
      'nombre' => $nombre,
      'email' => $correo,
      'tipo' => "empresa",
      'telefono' => $telefono,
      'contrasena' => $hash
    );

    // Agregar el nuevo usuario al array de usuarios
    $usuariosing[] = $nuevoUsuario;

    // Codificar el array de usuarios en formato JSON
    $nuevoJson = json_encode($usuariosing);

    // Guardar el nuevo JSON en el archivo usuarios.json
    file_put_contents('./JSON/ingusuario.json', $nuevoJson);

    // Incluir el archivo empresa_ingreso.php
    include './assets/empresa_ingreso.php';
  } else {
    echo "Usuario o Correo invalidos";
  }
}
?>

<form class="form-almacen" method="POST" autocomplete="off" class="sign-up-form">

  <div class="actual-form">

    <div class="input-wrap">
      <label>Usuario</label>
      <input type="text" id="user" name="user" minlength="4" class="input-field" autocomplete="off" required />
    </div>

    <style>
      #user_error {
        color: #FF0000;
      }
    </style>

    <div class="input-wrap">
      <label>RUT</label>
      <input type="text" id="rut" name="rut" minlength="12" maxlength="12" class="input-field" autocomplete="off" required />
    </div>

    <div class="input-wrap">
      <label>Nombre</label>
      <input type="text" id="nombre" name="nombre" minlength="1" pattern="([A-Za-z0-9 ._\\s]+)" class="input-field"
        autocomplete="off" required />
    </div>

    <div class="input-wrap">
      <label>Email</label>
      <input type="email" id="email" name="email" class="input-field" autocomplete="off" required />
    </div>

    <div class="input-wrap">
      <label>Telefono</label>
      <input type="tel" id="telefono" name="telefono" pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}" class="input-field"
        autocomplete="off" not required />
    </div>

    <div class="input-wrap">
      <label>Contraseña</label>
      <input type="password" id="contrase" name="contrase" minlength="8" class="input-field" autocomplete="off"
        required />
    </div> <br>

    <div class="centrar-enviar">
    <input class="enviar" type="submit" formtarget="_self" id="registroBTN" name="registrarse_" value="Registrarse" class="sign-btn" />
    </div>

  </div>
</form>

<?php
// Obtener datos del archivo JSON
include './assets/usuarios.php';
$json_data = file_get_contents('./JSON/usuarios.json');
$data = json_decode($json_data, true);

// Filtrar usuarios de tipo "empresa"
$empresas = array_filter($data, function ($user) {
  return $user['tipo'] === 'empresa';
});

// Generar la tabla HTML
echo '<table>';
echo '<tr><th>Usuario</th><th>Nombre</th><th>RUT</th><th>EMAIL</th><th>Teléfono</th><th>Eliminar</th><th>Actualizar</th></tr>';
foreach ($empresas as $empresa) {
  echo '<tr>';
  echo '<td>' . $empresa['usuario'] . '</td>';
  echo '<td>' . $empresa['nombre'] . '</td>';
  echo '<td>' . $empresa['rut'] . '</td>';
  echo '<td>' . $empresa['email'] . '</td>';
  echo '<td>' . $empresa['telefono'] . '</td>';
  echo '<td>';
  echo "<form action='#' method='post'>";
  echo "<input type='hidden' name='borrar_empresa' value='" . $empresa["id_user"] . "'>";
  echo "<input class='warning' type='submit' value='Eliminar'>";
  echo "</form>";
  echo '</td>';
  echo '<td>';
  echo "<form action='./dashempresaact.php' method='post'>";
  echo "<input type='hidden' name='actualizar_empresa' value='" . $empresa["id_user"] . "'>";
  echo "<input class='act' type='submit' value='Actualizar'>";
  echo "</form>";
  echo '</td>';
  echo '</tr>';
}
echo '</table>';


if (isset($_POST["borrar_empresa"])) {
  $id_user = $_POST["borrar_empresa"];

  // Conectar a la base de datos
  include './assets/conexion.php';

  // Eliminar la fila de paquete de la tabla "paquete"
  $sql = "DELETE FROM empresa WHERE id_user = '$id_user' LIMIT 1";

  if ($conn->query($sql) === TRUE) {

    $sql2 = "DELETE FROM usuario WHERE id_user = '$id_user' LIMIT 1";

    if ($conn->query($sql2) === TRUE) {
    } else {
    }

  } else {
  }

  echo "<meta http-equiv='refresh' content='0'>";
  include './assets/usuarios.php';
}



?>