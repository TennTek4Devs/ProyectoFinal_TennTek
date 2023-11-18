<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form class="form-almacen" action="#" method="POST" autocomplete="off">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <input class="enviar" type="submit" name="enviar_" value="Enviar">
        <br><br>
    </form>

    <?php
    // Obtener los datos del formulario
    if (isset($_POST['enviar_'])) {
        $nombre = $_POST["nombre"];

        // Crear un objeto JSON con los datos
        $data = array(
            "nombre" => $nombre,
            "estado" => 'abierto'
        );
        $jsonData = json_encode($data);

        // Escribir los datos en el archivo "inglotes.json"
        file_put_contents('./JSON/inglotes.json', $jsonData);

        include './assets/insertarlotes.php';
        include './assets/lotes.php';
    }
    ?>

    <table>
        <tr>
            <th>ID Lote</th>
            <th>Nombre</th>
            <th>Almacén</th>
            <th>Estado</th>
            <th>Accion</th>
            <th>Acciones</th>
        </tr>

        <?php

        // Leer los datos de la tabla "lotes"
        include './assets/conexion.php';
        $sql = "SELECT * FROM lotes";
        $result = $conn->query($sql);

        // Mostrar cada fila de lote en la tabla
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_lote"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>";
            ?><?php  
            echo $row["id_almacen"];
            if ($row["id_almacen"] == NULL){
                echo "Principal";
            }else{
                echo $row["id_almacen"];
            } 
            ?><?php 
            echo "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td>";
            echo "<form action='#' method='post'>";
            echo "<input type='hidden' name='borrar_lote' value='" . $row["id_lote"] . "'>";
            echo "<input class='warning' type='submit' value='Eliminar'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form action='./dashlotesact.php' method='post'>";
            echo "<input type='hidden' name='actualizar_lote' value='" . $row["id_lote"] . "'>";
            echo "<input class='act' type='submit' value='Actualizar'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }

        ?>

        <?php

        // Si se ha enviado el formulario de eliminación
        if (isset($_POST["borrar_lote"])) {
            $id_lote = $_POST["borrar_lote"];

            // Conectar a la base de datos
            include './assets/conexion.php';

            // Eliminar la fila de lote de la tabla "lotes"
            $sql = "DELETE FROM lotes WHERE id_lote = '$id_lote' LIMIT 1";

            if ($conn->query($sql) === TRUE) {
                echo "La fila de lote con ID $id_lote se ha eliminado correctamente de la tabla 'lotes'.";
            } else {
                echo "Error al eliminar la fila de lote con ID $id_lote: " . $conn->error;
            }

            echo "<meta http-equiv='refresh' content='0'>";
        }

        ?>
    </table>

</body>

</html>