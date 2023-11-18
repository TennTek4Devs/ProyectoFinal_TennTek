<?php

include './assets/almacenes.php';
$updtalmacenes = json_decode(file_get_contents('./JSON/updtalmacenes.json'), true);
$id_almacen = $updtalmacenes['actualizar_almacen'];
$id_almacen_actualizar = $id_almacen;

$almacenes = json_decode(file_get_contents('./JSON/almacenes.json'), true);
$selected_almacen = null;
foreach ($almacenes as $almacen) {
    if ($almacen['id_almacen'] == $id_almacen) {
        break;
    }
}

?>

<form class="form-almacen" action="./dashalmacen.php" method="post">
    <input type="hidden" name="id_almacen" value="<?php echo $id_almacen_actualizar; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $almacen['nombre']; ?>"><br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" value="<?php echo $almacen['direccion']; ?>"><br>
    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" value="<?php echo $almacen['cuidad']; ?>"><br>
    <input class="enviar" type="submit" name="enviar_actualizar" value="Enviar">
</form>