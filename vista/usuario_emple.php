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

  $fecha_actual = date('Y-m-d');
  $fecha_nacimiento = $_POST['fechaX'];
  // Calcular la diferencia entre las dos fechas
  $diferencia = date_diff(date_create($fecha_nacimiento), date_create($fecha_actual));
  // Obtener la edad en años
  $edad2 = $diferencia->y;

  $usuario = $_POST['user'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $ci = $_POST['ci'];
  $edad = $edad2;
  $correo = $_POST['email'];
  $telefono = $_POST['telefono'];
  $funcion = $_POST['funcion'];
  $cargo = $_POST['cargo'];
  $contragen = $_POST['contrase'];
  // Crear un hash de la contraseña utilizando password_hash()
  $hash = password_hash($contragen, PASSWORD_BCRYPT);

  // Verificar si los datos no están repetidos
  if (verificar_datos($usuario, $correo)) {
    // Crear un nuevo usuario
    $nuevoUsuario = array(
      'usuario' => $usuario,
      'nombre' => $nombre,
      'apellido' => $apellido,
      'ci' => $ci,
      'edad' => $edad,
      'email' => $correo,
      'telefono' => $telefono,
      'tipo' => "empleado",
      'funcion' => $funcion,
      'cargo' => $cargo,
      'contrasena' => $hash
    );

    // Codificar el array de usuarios en formato JSON
    $nuevoJson = json_encode($nuevoUsuario);

    // Guardar el nuevo JSON en el archivo usuarios.json
    file_put_contents('./JSON/ingusuario.json', $nuevoJson);

    // Incluir el archivo empresa_ingreso.php
    include './assets/empleado_ingreso.php';
  } else {
    echo "Usuario o Correo invalido.";
  }
}
?>

<form action="#" method="POST" autocomplete="off" class="form-almacen">
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
      <label>Nombre</label>
      <input type="text" id="nombre" name="nombre" minlength="1" pattern="([A-Za-z0-9 ._\\s]+)" class="input-field"
        autocomplete="off" required />
      
    </div>

    <div class="input-wrap">
      <label>Apellido</label>
      <input type="text" id="apellido" name="apellido" minlength="1" pattern="([A-Za-z0-9 ._\\s]+)" class="input-field"
        autocomplete="off" required />
      
    </div>

    <div class="input-wrap">
      <label>CI</label>
      <input type="text" id="ci" name="ci" minlength="1" maxlength="8" pattern="([A-Za-z0-9 ._\\s]+)" class="input-field"
        autocomplete="off" required />
      
    </div>

    <?php
    $fecha_actual = date('Y-m-d');
    // Obtener la fecha de hace 18 años
    $fecha_18_anios = date('Y-m-d', strtotime('-18 years', strtotime($fecha_actual)));
    // Obtener la fecha de hace 110 años
    $fecha_110_anios = date('Y-m-d', strtotime('-110 years', strtotime($fecha_actual)));
    ?>

    <div class="input-wrap">
      <label>Edad</label>
      <input type="date" id="fechaX" name="fechaX" min="<?php echo $fecha_110_anios; ?>"
        max="<?php echo $fecha_18_anios; ?>" class="input-field" autocomplete="off" required />
      
    </div>

    <div class="input-wrap">
      <label>Email</label>
      <input type="email" id="email" name="email" class="input-field" autocomplete="off" required />
      
    </div>

    <div class="input-wrap">
      <label>Teléfono</label>
      <input type="tel" id="telefono" name="telefono" pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}" class="input-field"
        autocomplete="off" required />
      
    </div>

    <div class="select-wrap">
      <label>Función</label>
      <select id="funcion" name="funcion" class="select-almacen" required>
        <option value="conductorNeta">Delivery</option>
        <option value="Funcionario">Funcionario</option>
        <option value="conductorMion">Camionero</option>
      </select>
      
    </div>

    <div class="input-wrap">
      <label>Cargo</label>
      <input type="text" id="cargo" name="cargo" class="input-field" autocomplete="off" required />
      
    </div>

    <div class="input-wrap">
      <label>Contraseña</label>
      <input type="password" id="contrase" name="contrase" minlength="8" class="input-field" autocomplete="off"
        required />
      
    </div>

    <input type="submit" formtarget="_self" id="registroBTN" name="registrarse_" value="Registrarse" class="enviar" />
  </div>
</form>

<?php
//if (isset($_POST['registrarse_'])){ if (verificar_usuario($_POST['user'])) {
//echo '<p id="user_error"> Error, Usuario existente.</p>';} } 
//if (isset($_POST['registrarse_'])){ if (verificar_usuario($_POST['email'])) {
//echo ' error, ya existe este correo.';} }
?>

<?php
// Obtener datos del archivo JSON
include './assets/usuarios.php';
$json_data = file_get_contents('./JSON/usuarios.json');
$data = json_decode($json_data, true);

// Filtrar usuarios de tipo "empresa"
$empleados = array_filter($data, function ($user) {
  return $user['tipo'] === 'empleado';
});

// Generar la tabla HTML
echo '<table>';
echo '<tr><th>Usuario</th><th>Nombre</th><th>Apellido</th><th>CI</th><th>RUT</th><th>Edad</th><th>E-Mail</th><th>Teléfono</th><th>Funcion</th><th>Cargo</th><th>Eliminar</th><th>Actualizar</th></tr>';
foreach ($empleados as $empleado) {
  echo '<tr>';
  echo '<td>' . $empleado['usuario'] . '</td>';
  echo '<td>' . $empleado['nombre'] . '</td>';
  echo '<td>' . $empleado['apellido'] . '</td>';
  echo '<td>' . $empleado['ci'] . '</td>';
  echo '<td>' . $empleado['rut'] . '</td>';
  echo '<td>' . $empleado['edad'] . '</td>';
  echo '<td>' . $empleado['email'] . '</td>';
  echo '<td>' . $empleado['telefono'] . '</td>';
  echo '<td>' . $empleado['empleado_funcion'] . '</td>';
  echo '<td>';
  if ($empleado['conductorNeta_cargo'] != NULL) {
    echo $empleado['conductorNeta_cargo'];
  } elseif ($empleado['conductorMion_cargo'] != NULL) {
    echo $empleado['conductorMion_cargo'];
  } elseif ($empleado['funcionario_cargo'] != NULL) {
    echo $empleado['funcionario_cargo'];
  }
  echo '</td>';
  echo '<td>';
  echo "<form method='post'>";
  echo "<input type='hidden' name='borrar_empleado' value='" . $empleado["id_user"] . "'>";
  echo "<input class='warning' type='submit' value='Eliminar'>";
  echo "</form>";
  echo '</td>';
  echo '<td>';
  echo "<form action='./dashempleadoact.php' method='post'>";
  echo "<input type='hidden' name='actualizar_empleado' value='" . $empleado['id_user'] . "'>";
  echo "<input class='act' type='submit' value='Actualizar'>";
  echo "</form>";
  echo '</td>';
  echo '</tr>';
}
echo '</table>';


if (isset($_POST["borrar_empleado"])) {
  $id_user = $_POST["borrar_empleado"];

  // Conectar a la base de datos
  include './assets/conexion.php';

  if ($empleado['conductorNeta_cargo'] != null) {
    $sql_opt = "DELETE FROM conductorNeta WHERE id_user = '$id_user' LIMIT 1";
  } elseif ($empleado['conductorMion_cargo'] != null) {
    $sql_opt = "DELETE FROM conductorMion WHERE id_user = '$id_user' LIMIT 1";
  } elseif ($empleado['funcionario_cargo'] != null) {
    $sql_opt = "DELETE FROM funcionario WHERE id_user = '$id_user' LIMIT 1";
  }

  if ($conn->query($sql_opt) === TRUE) {
    // Codigo post funcion
    // Eliminar la fila de paquete de la tabla "paquete"
    $sql = "DELETE FROM empleado WHERE id_user = '$id_user' LIMIT 1";

    if ($conn->query($sql) === TRUE) {
      $sql2 = "DELETE FROM usuario WHERE id_user = '$id_user' LIMIT 1";
      if ($conn->query($sql2) === TRUE) {
      } else {
      }
    } else {
    }
    // Codigo post funcion
  } else {
  }

  echo "<meta http-equiv='refresh' content='0'>";
  include './assets/usuarios.php';
}

?>