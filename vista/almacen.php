<html>

<head>
    <title>Formulario de almacenes</title>
</head>

<body>
    <form class="form-almacen" id="form-close" method="post" action="#">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" minlength="4"><br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" minlength="5"><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" minlength="4"><br>
        <div class="centrar-enviar">
            <input class="enviar" type="submit" name="ing_almacenes" value="Agregar">
        </div>
    </form>

    <?php

    if (isset($_POST['ing_almacenes'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];

        // Crear un array asociativo con los datos
        $data = array(
            'nombre' => $nombre,
            'direccion' => $direccion,
            'ciudad' => $ciudad
        );

        // Convertir el array a formato JSON
        $json = json_encode($data);

        // Guardar el JSON en un archivo
        file_put_contents('./JSON/ingalmacenes.json', $json);
        include './assets/insertaralmacenes.php';
    }


    // Include a archivo "Almacenes.php"
    include './assets/almacenes.php';
    // Lee el archivo JSON
    $json = file_get_contents('./JSON/almacenes.json');

    // Decodifica el JSON en un array asociativo
    $data = json_decode($json, true);

    // Crea la tabla HTML
    echo '<table>';
    echo '<thead><tr><th>ID Almacen</th><th>Nombre</th><th>Direccion</th><th>Ciudad</th><th>Acciones</th></tr></thead>';
    echo '<tbody>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id_almacen'] . '</td>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>' . $row['direccion'] . '</td>';
        echo '<td>' . $row['cuidad'] . '</td>';
        echo '<td class="warning">';
        echo "<form action='#' method='post'>";
        echo "<input type='hidden' name='eliminar_almacen' value='" . $row["id_almacen"] . "'>";
        echo "<input class='warning' type='submit' value='Eliminar'>";
        echo "</form>";
        echo '</td>';
        echo '<td>';
        echo "<form action='./dashalmacenact.php' method='post'>";
        echo "<input type='hidden' name='actualizar_almacen' value='" . $row["id_almacen"] . "'>";
        echo "<input class='act' type='submit' value='Actualizar'>";
        echo "</form>";
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<br>';
    echo '<br>';

    if (isset($_POST['eliminar_almacen'])) {
        // Obtener el id_almacen del formulario
        $id_almacenhid = $_POST['eliminar_almacen'];
        echo $id_almacenhid;

        // Conectar a la base de datos
        include './assets/conexion.php';

        // Eliminar el registro de la tabla "Almacen"
        $sql5 = "DELETE FROM almacen WHERE id_almacen = $id_almacenhid";
        if ($conn->query($sql5) === TRUE) {
            echo "El registro se ha eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }

        // Si se ha enviado el formulario de eliminación
        echo "<meta http-equiv='refresh' content='0'>";
    }

    ?>
</body>

</html>