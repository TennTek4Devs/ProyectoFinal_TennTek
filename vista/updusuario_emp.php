<?php

$updtempresas = json_decode(file_get_contents('./JSON/updtempresa.json'), true);
$id_user = $updtempresas['actualizar_empresa'];
$id_user_actualizar = $id_user;

$empresas = json_decode(file_get_contents('./JSON/usuarios.json'), true);
$selected_lote = null;
foreach ($empresas as $empresa) {
    if ($empresa['id_user'] == $id_user) {
        $id_actualizado = $empresa['id_user'];
        break;
    }
}

?>


<form class="form-almacen" action="./dashempresa.php" method="post">

    <input type="hidden" name="id_actualizado" value="<?php echo $id_actualizado; ?>">

    <label>Usuario</label><br>
    <input type="text" id="user" name="useract" value="<?php echo $empresa['usuario']; ?>" minlength="4"
        class="input-field" autocomplete="off" required /><br>

    <style>
        #user_error {
            color: #FF0000;
        }
    </style>


    <label>Nombre</label><br>
    <input type="text" id="nombre" name="nombreact" value="<?php echo $empresa['nombre']; ?>" minlength="1"
        pattern="([A-Za-z0-9 ._\\s]+)" class="input-field" autocomplete="off" required /><br>

    <label>RUT</label><br>
    <input type="text" id="rut" name="rutact" value="<?php echo $empresa['rut']; ?>" minlength="8" class="input-field"
        autocomplete="off" required /><br>

    <label>Email</label><br>
    <input type="email" id="email" name="emailact" value="<?php echo $empresa['email']; ?>" class="input-field"
        autocomplete="off" required /><br>

    <label>Telefono</label><br>
    <input type="tel" id="telefono" name="telefonoact" value="<?php echo $empresa['telefono']; ?>"
        pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}" class="input-field" autocomplete="off" not required /><br>

    <input type="submit" formtarget="_self" id="actualizacionBTN" name="enviar_actualizar" value="Actualizar"
        class="enviar" />

</form>