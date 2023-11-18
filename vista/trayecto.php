<form class="form-almacen" method="post" action="">
  <div class="select-wrap">
    <label for="ruta">Ruta:</label>
    <select name="ruta" id="ruta">
      <?php
      // Conexión a la base de datos
      include './assets/conexion.php';

      // Consulta para obtener los datos de la tabla "ruta"
      $query = "SELECT id_ruta FROM ruta";
      $result = $conn->query($query);

      // Creación de las opciones del select
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_ruta'] . "'>" . $row['id_ruta'] . "</option>";
      }

      // Liberación de los resultados y cierre de la conexión
      $result->free();
      $conn->close();
      ?>
    </select>
  </div>

  <br>
  <div class="select-wrap">
    <label for="almacen">Almacén:</label>
    <select name="almacen" id="almacen">
      <?php
      // Conexión a la base de datos
      include './assets/conexion.php';

      // Consulta para obtener los datos de la tabla "almacen"
      $query = "SELECT id_almacen FROM almacen";
      $result = $conn->query($query);

      // Creación de las opciones del select
      while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_almacen'] . "'>" . $row['id_almacen'] . "</option>";
      }

      // Liberación de los resultados y cierre de la conexión
      $result->free();
      $conn->close();
      ?>
    </select>
  </div>
  <br>

  <label for="orden">Orden:</label>
  <input type="text" name="orden" id="orden">

  <br>

  <input class="enviar" type="submit" name="enviar_trayecto" value="Enviar">
</form>

<?php
// Establecer la conexión a la base de datos
include './assets/conexion.php';

// Obtener los valores del formulario
if (isset($_POST['enviar_trayecto'])) {

  $ruta = $_POST['ruta'];
  $almacen = $_POST['almacen'];
  $orden = $_POST['orden'];


  // Insertar los valores en la tabla "trayecta"
  $sql = "INSERT INTO trayecta (id_ruta, id_almacen, orden) VALUES ('$ruta', '$almacen', '$orden')";

  if (mysqli_query($conn, $sql)) {
    echo "Los datos se insertaron correctamente.";
  } else {
    echo "Error al insertar los datos: " . mysqli_error($conn);
  }
}


// Cerrar la conexión
mysqli_close($conn);
?>


<?php
// Establecer la conexión a la base de datos
include './assets/conexion.php';

// Verificar la conexión
if (!$conn) {
  die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener los datos de la tabla "trayecta"
$sql = "SELECT * FROM trayecta";
$result = mysqli_query($conn, $sql);

// Mostrar los datos en una tabla HTML
echo "<table>";
echo "<tr><th>ID Ruta</th><th>ID Almacén</th><th>Orden</th><th>Eliminar</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row["id_ruta"] . "</td>";
  echo "<td>" . $row["id_almacen"] . "</td>";
  echo "<td>" . $row["orden"] . "</td>";
  echo "<form method='post'>";
  echo "<input type='hidden' name='id_tray2' value='" . $row['id_ruta'] . "'></input>";
  echo "<input type='hidden' name='id_tray' value='" . $row['id_almacen'] . "'></input>";
  echo "<td><input class='warning' type='submit' name='eliminar_trayecto' value='Eliminar'></input></td>";
  echo "</form>";
  echo "</tr>";
}
echo "</table>";


// Cerrar la conexión
mysqli_close($conn);
?>

<?php
// Establecer la conexión a la base de datos
include './assets/conexion.php';

// Obtener el valor del atributo "id"
if (isset($_POST['eliminar_trayecto'])) {
  $id = $_POST["id_tray"];
  $id2 = $_POST['id_tray2'];

  // Eliminar la fila correspondiente de la tabla "trayecta"
  $sql = "DELETE FROM trayecta WHERE id_almacen='$id' AND id_ruta='$id2'";

  if (mysqli_query($conn, $sql)) {
    echo "La fila se eliminó correctamente.";
  } else {
    echo "Error al eliminar la fila: " . mysqli_error($conn);
  }

  // Cerrar la conexión
  mysqli_close($conn);
  echo "<meta http-equiv='refresh' content='0'>";
}
?>