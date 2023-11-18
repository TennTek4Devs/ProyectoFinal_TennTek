<?php

$updtempleado = json_decode(file_get_contents('./JSON/updtempleado.json'), true);
$id_user = $updtempleado['actualizar_empleado'];
$id_user_actualizar = $id_user;

$empleados = json_decode(file_get_contents('./JSON/usuarios.json'), true);
$selected_lote = null;
foreach ($empleados as $empleado) {
  if ($empleado['id_user'] == $id_user) {
    $id_actualizado = $empleado['id_user'];
    break;
  }
}

?>


<form method="post">
  <input type="text" id="user" name="user" value="<?php echo $empleado['usuario']; ?>" minlength="4" class="input-field"
    autocomplete="off" required />
  <label>Usuario
    <?php if (isset($_POST['registrarse_'])) {
      if (verificar_usuario($_POST['user'])) {
        echo '<p id="user_error"> Error, Usuario existente.</p>';
      }
    } ?>
  </label>
  <br>

  <style>
    #user_error {
      color: #FF0000;
    }
  </style>

  <input type="text" id="nombre" name="nombre" value="<?php echo $empleado['nombre']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />
  <label>Nombre</label>
  <br>

  <input type="text" id="apellido" name="apellido" value="<?php echo $empleado['apellido']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />
  <label>Apellido</label>
  <br>

  <input type="text" id="ci" name="ci" value="<?php echo $empleado['ci']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />
  <label>CI</label>
  <br>

  <input type="text" id="rut" name="rut" value="<?php echo $empleado['rut']; ?>" minlength="12" maxlength="12"
    class="input-field" autocomplete="off" required />
  <label>RUT</label>
  <br>

  <input type="email" id="email" name="email" value="<?php echo $empleado['email']; ?>" class="input-field"
    autocomplete="off" required />
  <label>Email
    <?php if (isset($_POST['registrarse_'])) {
      if (verificar_usuario($_POST['email'])) {
        echo ' error, ya existe este correo.';
      }
    } ?>
  </label>
  <br>

  <input type="tel" id="telefono" name="telefono" value="<?php echo $empleado['telefono']; ?>"
    pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}" class="input-field" autocomplete="off" required />
  <label>Teléfono</label>
  <br>

  <input type="submit" formtarget="_self" id="actualizacionBTN" name="enviar_actualizar" value="Actualizar"
    class="sign-btn" />
</form>

<?php

if (isset($_POST['enviar_actualizar'])) {
  global $id_actualizado;

  $usuario = $_POST['user'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $ci = $_POST['ci'];
  $rut = $_POST['rut'];
  $correo = $_POST['email'];
  $telefono = $_POST['telefono'];

  $nuevoUsuario = array(
    'id_user' => $id_actualizado,
    'usuario' => $usuario,
    'ci' => $ci,
    'rut' => $rut,
    'nombre' => $nombre,
    'apellido' => $apellido,
    'email' => $correo,
    'tipo' => "empleado",
    'telefono' => $telefono
  );
  $json_data = json_encode($nuevoUsuario);
  file_put_contents('./JSON/updtempleado.json', $json_data);
  include './assets/updtempresa.php';
}

if (isset($_POST["enviar_actualizar"])) {

}

?>