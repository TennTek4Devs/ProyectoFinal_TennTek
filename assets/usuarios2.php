<?php
require "conexion.php";

$sql = "SELECT
        u.*,
        e.funcion AS empleado_funcion,
        cn.cargo AS conductorNeta_cargo,
        cm.cargo AS conductorMion_cargo,
        f.cargo AS funcionario_cargo
        FROM
        usuario AS u
        LEFT JOIN
        empleado AS e ON e.id_user = u.id_user
        LEFT JOIN
        conductorNeta AS cn ON cn.id_user = e.id_user
        LEFT JOIN
        conductorMion AS cm ON cm.id_user = e.id_user
        LEFT JOIN
        funcionario AS f ON f.id_user = e.id_user
      ;";
$resultado = mysqli_query($conn, $sql);

$usuarios = array();

while ($fila = mysqli_fetch_assoc($resultado)) {  
  $usuarios[] = $fila;
}

$json_usuarios = json_encode($usuarios);

file_put_contents('./JSON/usuarios.json', $json_usuarios);

?>