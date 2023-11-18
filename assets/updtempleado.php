<?php

$json_data = file_get_contents('./JSON/updtempleado.json');
$datacro = json_decode($json_data, true);

include 'conexion.php';

$id_user = $datacro['id_user'];
$usuario = $datacro['usuario'];
$nombre = $datacro['nombre'];
$apellido = $datacro['apellido'];
$ci = $datacro['ci'];
$email = $datacro['email'];
$telefono = $datacro['telefono'];
$funcion = $datacro['funcion'];
$cargo = $datacro['cargo'];
if ($funcion == "Delivery") {

    $query3 = "UPDATE conductorNeta
            SET cargo='$cargo' WHERE id_user='$id_user'";
    mysqli_query($conn, $query3);
} elseif ($funcion == "Camionero") {

    $query3 = "UPDATE conductorMion
            SET cargo='$cargo' WHERE id_user='$id_user'";
    mysqli_query($conn, $query3);
} elseif ($funcion == "Funcionario") {

    $query3 = "UPDATE funcionario
            SET cargo='$cargo' WHERE id_user='$id_user'";
    mysqli_query($conn, $query3);
}


$query =
    "UPDATE usuario 
    SET usuario='$usuario', nombre='$nombre', apellido='$apellido', 
        ci='$ci', email='$email', telefono='$telefono', tipo='empleado'
    WHERE id_user='$id_user'";
mysqli_query($conn, $query);

if ($funcion == "Delivery") {
    $query2 =
        "UPDATE empleado
        SET funcion='conductorNeta'
        WHERE id_user='$id_user'";
    mysqli_query($conn, $query2);
} elseif ($funcion == "Camionero") {
    $query2 =
        "UPDATE empleado
        SET funcion='conductorMion'
        WHERE id_user='$id_user'";
    mysqli_query($conn, $query2);
} elseif ($funcion == "Funcionario") {
    $query2 =
        "UPDATE empleado
        SET funcion='Funcionario'
        WHERE id_user='$id_user'";
    mysqli_query($conn, $query2);
}


mysqli_close($conn);

?>