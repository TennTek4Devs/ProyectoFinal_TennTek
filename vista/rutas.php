<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Ruta</title>
</head>

<body>
    <form class="form-almacen" action="#" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <br><br>

        <input class="enviar" type="submit" name="enviar_ruta" value="Enviar">
    </form>
</body>

</html>

<?php
if (isset($_POST['enviar_ruta'])) {
    // Obtener el valor de nombre desde el formulario
    $nombre = $_POST['nombre'];

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para insertar en la tabla ruta
    $sql_insert = "INSERT INTO ruta (nombre) VALUES ('$nombre')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Datos insertados correctamente en la tabla ruta.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Rutas</title>
</head>

<body>
    <h2>Tabla de Rutas</h2>
    <table>
        <tr>
            <th>ID Ruta</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los registros de la tabla ruta
        $sql_rutas = "SELECT * FROM ruta";
        $result_rutas = $conn->query($sql_rutas);

        while ($row = $result_rutas->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_ruta'] . '</td>';
            echo '<td>' . $row['nombre'] . '</td>';
            echo '<td><form action="#" method="post">';
            echo '<input type="hidden" name="id_ruta" value="' . $row['id_ruta'] . '">';
            echo '<input class="warning" type="submit" name="eliminar_ruta" value="Eliminar">';
            echo '</form></td>';
            echo '</tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
if (isset($_POST['eliminar_ruta'])) {
    // Obtener el ID de ruta desde el formulario
    $id_ruta = $_POST['id_ruta'];

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para eliminar la fila de la tabla ruta
    $sql_delete = "DELETE FROM ruta WHERE id_ruta = '$id_ruta'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Fila eliminada correctamente.";
    } else {
        echo "Error al eliminar la fila: " . $conn->error;
    }

    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
}
?>