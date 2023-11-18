<?php
// Obtener datos del archivo JSON
include './assets/usuarios.php';
$json_data = file_get_contents('./JSON/usuarios.json');
$data = json_decode($json_data, true);

// Filtrar usuarios de tipo "empresa"
$empleados = array_filter($data, function ($user) {
    return $user['tipo'] === 'cliente';
});

// Generar la tabla HTML
echo '<table>';
echo '<tr><th>Usuario</th><th>Nombre</th><th>Apellido</th><th>CI</th><th>RUT</th><th>Edad</th><th>E-Mail</th><th>Teléfono</th><th>Eliminar</th></tr>';
foreach ($empleados as $empleado) {
    echo '<tr>';
    echo '<td>' . $empleado['usuario'] . '</td>';
    echo '<td>' . $empleado['nombre'] . '</td>';
    echo '<td>' . $empleado['apellido'] . '</td>';
    echo '<td>' . $empleado['ci'] . '</td>';
    echo '<td>' . $empleado['rut'] . '</td>';
    echo '<td>' . $empleado['edad'] . '</td>';
    echo '<td>' . $empleado['email'] . '</td>';
    echo '<td>' . $empleado['telefono'] . '</td>';

    echo '<td>';
    echo "<form method='post'>";
    echo "<input type='hidden' name='borrar_empleado' value='" . $empleado["id_user"] . "'>";
    echo "<input class='warning' type='submit' value='Eliminar'>";
    echo "</form>";
    echo '</td>';
    echo '<td>';

    echo '</td>';
    echo '</tr>';
}
echo '</table>';


if (isset($_POST["borrar_empleado"])) {
  $id_user = $_POST["borrar_empleado"];

  // Conectar a la base de datos
  include './assets/conexion.php';

  if ($conn->query($sql_opt) === TRUE) {
    // Codigo post funcion
    // Eliminar la fila de paquete de la tabla "paquete"
    $sql = "DELETE FROM cliente WHERE id_user = '$id_user' LIMIT 1";

    if ($conn->query($sql) === TRUE) {
    $sql2 = "DELETE FROM usuario WHERE id_user = '$id_user' LIMIT 1";
      if ($conn->query($sql2) === TRUE) {}else{}
    }else{}
  // Codigo post funcion
  }else{}

  echo "<meta http-equiv='refresh' content='0'>";
  include './assets/usuarios.php';
}

?>