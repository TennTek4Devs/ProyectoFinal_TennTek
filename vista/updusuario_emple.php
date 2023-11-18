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


<form class="form-almacen" action="./dashempleado.php" method="post">
  <input type="hidden" name="id_user_actualizar" value="<?php echo $id_user_actualizar; ?>">
  <label>Usuario
  <input type="text" id="user" name="user" value="<?php echo $empleado['usuario']; ?>" minlength="4" class="input-field"
    autocomplete="off" required />
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
  <label>Nombre</label>
  <input type="text" id="nombre" name="nombre" value="<?php echo $empleado['nombre']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />

  <br>
  <label>Apellido</label>
  <input type="text" id="apellido" name="apellido" value="<?php echo $empleado['apellido']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />

  <br>
  <label>CI</label>
  <input type="text" id="ci" name="ci" value="<?php echo $empleado['ci']; ?>" minlength="1"
    pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required />

  <br>
  <label>Email
    <?php if (isset($_POST['registrarse_'])) {
      if (verificar_usuario($_POST['email'])) {
        echo ' error, ya existe este correo.';
      }
    } ?>
  </label>
  <input type="email" id="email" name="email" value="<?php echo $empleado['email']; ?>" class="input-field"
    autocomplete="off" required />

  <br>
  <label>Teléfono</label>
  <input type="tel" id="telefono" name="telefono" value="<?php echo $empleado['telefono']; ?>"
    pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}" class="input-field" autocomplete="off" required />

  <br>
  <label>Función</label>
  <div class="select-wrap">
    <select id="funcion" name="funcion" class="input-field" required>
      <option value="delivery">Delivery</option>
      <option value="funcionario">Funcionario</option>
      <option value="camionero">Camionero</option>
    </select>
  </div>
  <br>
  <label>Cargo</label>
  <input type="text" id="cargo" name="cargo" value="<?php if ($empleado['conductorNeta_cargo'] != null) {
    echo $empleado['conductorNeta_cargo'];
  } elseif ($empleado['conductorMion_cargo'] != null) {
    echo $empleado['conductorMion_cargo'];
  } elseif ($empleado['funcionario_cargo'] != null) {
    echo $empleado['funcionario_cargo'];
  } ?>" class="input-field" autocomplete="off" required />

  <br>

  <input type="submit" formtarget="_self" id="actualizacionBTN" name="enviar_actualizar" value="Actualizar"
    class="enviar" />
</form>