<?php

    $json_data = file_get_contents('./JSON/updtempresa.json');
    $datacro = json_decode($json_data, true);

    include 'conexion.php';

    $id_user = $datacro['id_user'];
    $usuario = $datacro['usuario'];
    $nombre = $datacro['nombre'];
    $rut = $datacro['rut'];
    $email = $datacro['email'];
    $telefono = $datacro['telefono'];

    $query = "UPDATE usuario SET usuario='$usuario', nombre='$nombre', rut='$rut', email='$email', telefono='$telefono' WHERE id_user='$id_user'";
    mysqli_query($conn, $query);

    mysqli_close($conn);

?>