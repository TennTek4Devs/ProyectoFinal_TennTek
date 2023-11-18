<?php

$json_data = file_get_contents('./JSON/updtlotes.json');
$datacro = json_decode($json_data, true);

include 'conexion.php';

$id_lote = $datacro['id_lote'];
$nombre = $datacro['nombre'];
$estado = $datacro['estado'];
$almacen = $datacro['almacen'];
if ($datacro['almacen'] == "Principal") {
    $query = "UPDATE lotes SET nombre='$nombre', id_almacen=NULL, estado='$estado' WHERE id_lote='$id_lote'";
    mysqli_query($conn, $query);
} else {
    $query = "UPDATE lotes SET nombre='$nombre', id_almacen='$almacen', estado='$estado' WHERE id_lote='$id_lote'";
    mysqli_query($conn, $query);
}



mysqli_close($conn);

?>