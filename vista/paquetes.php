<!DOCTYPE html>
<html>

<head>
  <title>Formulario</title>
</head>

<body>
  <form class="form-almacen" method="post" action="#">
    <div class="select-wrap">
      <label for="id_lote">ID Lote:</label>
      <select name="id_lote" required>
        <?php
        // Leer el archivo JSON de lotes
        $lotes = file_get_contents('./JSON/lotes.json');
        $lotes = json_decode($lotes, true);

        // Mostrar cada lote como opción
        foreach ($lotes as $lote) {
          echo '<option value="' . $lote['id_lote'] . '">' . $lote['nombre'] . '</option>';
          $origen = $lote['almacen'];
        }
        ?>
      </select><br><br>
    </div>

    <div class="select-wrap">
      <label for="id_user">ID Usuario:</label>
      <select name="id_user" required>
        <?php
        include './assets/usuarios_emp.php';
        // Leer el archivo JSON de usuarios
        $usuarios = file_get_contents('./JSON/usuarios.json');
        $usuarios = json_decode($usuarios, true);

        // Mostrar cada usuario como opción
        foreach ($usuarios as $usuario) {
          if ($usuario['tipo'] == "empresa") {
            echo '<option value="' . $usuario['id_user'] . '">' . $usuario['usuario'] . '</option>';
          }
        }
        ?>
      </select><br><br>
    </div>

    <label for="ci">CI:</label>
    <input type="text" name="ci"><br>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre"><br>

    <label for="peso">Peso:</label>
    <input type="text" name="peso"><br>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad"><br>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion"><br>

    <label for="mail">Mail:</label>
    <input type="text" name="mail"><br>

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono"><br>

    <input class="enviar" type="submit" name="enviar_paquete" value="Enviar">
  </form>
</body>

</html>

<?php
if (isset($_POST['enviar_paquete'])) {
  // Obtener los datos del formulario
  global $origen;
  $id_lote = $_POST['id_lote'];
  $id_user = $_POST['id_user'];
  $ci = $_POST['ci'];
  $nombre = $_POST['nombre'];
  $peso = $_POST['peso'];
  $ciudad = $_POST['ciudad'];
  $direccion = $_POST['direccion'];
  $origen_ = $origen;
  $mail = $_POST['mail'];
  $telefono = $_POST['telefono'];

  // Crear un array con los datos del formulario
  $data = array(
    'id_paquete' => $id_paquete,
    'id_lote' => $id_lote,
    'id_user' => $id_user,
    'ci' => $ci,
    'nombre' => $nombre,
    'peso' => $peso,
    'ciudad' => $ciudad,
    'direccion' => $direccion,
    'origen' => $origen_,
    'mail' => $mail,
    'telefono' => $telefono
  );

  // Convertir el array a formato JSON
  $json = json_encode($data);

  // Guardar los datos en un archivo JSON
  $file = './JSON/ingpaquete.json';
  file_put_contents($file, $json);

  include './assets/ingpaquete.php';
  include './assets/paquete.php';
  echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php
// Leer el archivo JSON
include './assets/paquete.php';
$jsondata = file_get_contents("./JSON/paquetes.json");

// Convertir el contenido JSON en un array de PHP
$data = json_decode($jsondata, true);

// Crear la tabla HTML
echo "<table>";
echo "<tr><th>ID Paquete</th><th>ID Lote</th><th>ID Usuario</th><th>CI</th><th>Nombre</th><th>Peso</th><th>Ciudad</th><th>Dirección</th><th>Mail</th><th>Teléfono</th><th>Eliminar</th><th>Modificar</th></tr>";
foreach ($data as $row) {
  echo "<tr>";
  echo "<td>" . $row["id_paquete"] . "</td>";
  echo "<td>" . $row["id_lote"] . "</td>";
  echo "<td>" . $row["id_user"] . "</td>";
  echo "<td>" . $row["ci"] . "</td>";
  echo "<td>" . $row["nombre"] . "</td>";
  echo "<td>" . $row["peso"] . "</td>";
  echo "<td>" . $row["ciudad"] . "</td>";
  echo "<td>" . $row["direccion"] . "</td>";
  echo "<td>" . $row["mail"] . "</td>";
  echo "<td>" . $row["telefono"] . "</td>";
  echo "<td>";
  echo "<form action='#' method='post'>";
  echo "<input type='hidden' name='borrar_paquete' value='" . $row["id_paquete"] . "'>";
  echo "<input class='warning' type='submit' value='Eliminar'>";
  echo "</form>";
  echo "</td>";
  echo "<td>";
  echo "<form action='./dashpaquetesact.php' method='post'>";
  echo "<input type='hidden' name='actualizar_paquete' value='" . $row["id_paquete"] . "'>";
  echo "<input class='act' type='submit' value='Modificar'>";
  echo "</form>";
  echo "</td>";
  echo "</tr>";
}
echo "</table>";

// Si se presionó el botón "Eliminar"
if (isset($_POST["borrar_paquete"])) {
  $id_paquete = $_POST["borrar_paquete"];

  // Conectar a la base de datos
  include './assets/conexion.php';

  // Eliminar la fila de paquete de la tabla "paquete"
  $sql = "DELETE FROM paquete WHERE id_paquete = '$id_paquete' LIMIT 1";

  if ($conn->query($sql) === TRUE) {
    echo "La fila de paquete con ID $id_paquete se ha eliminado correctamente de la tabla 'paquete'.";
  } else {
    echo "Error al eliminar la fila de paquete con ID $id_paquete: " . $conn->error;
  }

  echo "<meta http-equiv='refresh' content='0'>";
  include './assets/paquete.php';
}

?>