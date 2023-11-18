<?php

    $json_data = file_get_contents('./JSON/updtalmacenes.json');
    $datacro = json_decode($json_data, true);

    include 'conexion.php';

    $id_almacen = $datacro['id_almacen'];
    $nombre = $datacro['nombre'];
    $direccion = $datacro['direccion'];
    $ciudad = $datacro['ciudad'];
    $query = "UPDATE almacen SET nombre='$nombre', direccion='$direccion', cuidad='$ciudad' WHERE id_almacen='$id_almacen'";
    mysqli_query($conn, $query);

    mysqli_close($conn);
    include 'almacenes.php';
?>