<?php
include './assets/almacenes.php';
$updtlotes = json_decode(file_get_contents('./JSON/updtlotes.json'), true);
$id_lote = $updtlotes['actualizar_lote'];
$id_lote_actualizar = $id_lote;

include './assets/lotes.php';
$lotes = json_decode(file_get_contents('./JSON/lotes.json'), true);
$selected_lote = null;
foreach ($lotes as $lote) {
    if ($lote['id_lote'] == $id_lote) {
        break;
    }
}

$almacenes = json_decode( file_get_contents('./JSON/almacenes.json'), true);

?>


<form class="form-almacen" action="./dashlotes.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="hidden" name="id_lote_actualizar" value="<?php echo $id_lote_actualizar ?>">
    <input type="text" name="nombre" value="<?php echo $lote['nombre']; ?>"><br>
    <div class="select-wrap">
    <label for="almacen">Almacen:</label>
    <select name="almacen">
        <option value="Principal">Principal</option>
        <?php foreach ($almacenes as $almacen) { ?>
            <option value="<?php echo $almacen['id_almacen']; ?>">
                <?php echo $almacen['nombre']; ?>
            </option>
        <?php } ?>
    </select><br>
</div>
<div class="select-wrap">
    <label for="estado">Estado:</label>
    <select name="estado" value="<?php echo $lote['id_almacen']; ?>">
        <option value="abierto" <?php if ($lote['estado'] == 'abierto') {
            echo 'selected';
        } ?>>Abierto</option>
        <option value="cerrado" <?php if ($lote['estado'] == 'cerrado') {
            echo 'selected';
        } ?>>Cerrado</option>
    </select><br>
</div>
    <input class="enviar" type="submit" name="enviar_actualizar" value="Enviar">
</form>