<!DOCTYPE html>
<html>

<head>
    <title>Formulario de Manejo</title>
    <?php include './assets/conexion.php'; ?>
</head>

<body>
    <form class="form-almacen" action="#" method="post">
        <div class="select-wrap">
            <label for="conductor">Selecciona un conductor:</label>
            <select name="conductor" id="conductor">
                <?php
                // Conexión a la base de datos (ajusta los valores según tu configuración)
                

                // Consulta para obtener los conductores desde la tabla conductorNeta
                $sql_conductores = "SELECT id_user
            FROM conductorneta
            WHERE id_user NOT IN (
                SELECT id_user
                FROM manejaNeta
                WHERE fecha_fin IS NULL
            );";
                $result_conductores = $conn->query($sql_conductores);

                if ($result_conductores->num_rows > 0) {
                    while ($row = $result_conductores->fetch_assoc()) {
                        echo '<option value="' . $row['id_user'] . '">' . $row['id_user'] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay conductores disponibles</option>';
                }

                ?>
            </select>
        </div>

        <br><br>
        <div class="select-wrap">
            <label for="camion">Selecciona una camioneta:</label>
            <select name="camion" id="camion">
                <?php
                // Conexión a la base de datos (ajusta los valores según tu configuración)
                include './assets/conexion.php';

                // Consulta para obtener las matrículas desde la tabla camioneta
                $sql_camiones = "SELECT matricula
            FROM camioneta
            WHERE matricula NOT IN (
                SELECT matricula
                FROM manejaNeta
                WHERE fecha_fin IS NULL
            );";
                $result_camiones = $conn->query($sql_camiones);

                if ($result_camiones->num_rows > 0) {
                    while ($row = $result_camiones->fetch_assoc()) {
                        echo '<option value="' . $row['matricula'] . '">' . $row['matricula'] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay camiones disponibles</option>';
                }

                ?>
            </select>
        </div>
        <br><br>

        <input type="submit" name="enviar_manejo" value="Enviar">
    </form>
</body>

</html>

<?php
if (isset($_POST['enviar_manejo'])) {
    // Obtener los valores seleccionados
    $conductor = $_POST['conductor'];
    $camion = $_POST['camion'];

    // Obtener la fecha actual
    $fecha_inicio = date("Y-m-d");

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para insertar en la tabla manejaMion
    $sql_insert = "INSERT INTO manejaNeta (id_user, matricula, fecha_inico, fecha_fin)
                   VALUES ('$conductor', '$camion', '$fecha_inicio', NULL)";

    if ($conn->query($sql_insert) === TRUE) {
        echo '<br>';
        echo "Datos insertados correctamente en la tabla manejaMion.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<html>

<head>
    <title>Manejo Pendiente</title>
</head>

<body>
    <h2>Manejo Pendiente</h2>
    <table border="1">
        <tr>
            <th>ID User</th>
            <th>Matrícula</th>
            <th>Fecha Inicio</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los registros con fecha_fin = null
        $sql_pendientes = "SELECT * FROM manejaneta WHERE fecha_fin IS NULL";
        $result_pendientes = $conn->query($sql_pendientes);

        if ($result_pendientes->num_rows > 0) {
            while ($row = $result_pendientes->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_user'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['fecha_inico'] . '</td>';
                echo '<td><form action="#" method="post">';
                echo '<input type="hidden" name="id_user" value="' . $row['id_user'] . '">';
                echo '<input type="submit" name="finalizar_manejo" value="Finalizar">';
                echo '</form></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay manejo pendiente.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
if (isset($_POST['finalizar_manejo'])) {
    // Obtener el ID de usuario desde el formulario
    $id_user = $_POST['id_user'];

    // Obtener la fecha actual
    $fecha_fin = date("Y-m-d H:i:s");

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para actualizar la fecha_fin
    $sql_update = "UPDATE manejaneta SET fecha_fin = '$fecha_fin' WHERE id_user = '$id_user' AND fecha_fin IS NULL";

    if ($conn->query($sql_update) === TRUE) {
        echo "Manejo finalizado correctamente.";
    } else {
        echo "Error al finalizar el manejo: " . $conn->error;
    }

    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manejo Finalizado</title>
</head>

<body>
    <h2>Manejo Finalizado</h2>
    <table border="1">
        <tr>
            <th>ID User</th>
            <th>Matrícula</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
        </tr>
        <?php

        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los registros con fecha_fin distinta de null
        $sql_finalizados = "SELECT * FROM manejaneta WHERE fecha_fin IS NOT NULL";
        $result_finalizados = $conn->query($sql_finalizados);

        if ($result_finalizados->num_rows > 0) {
            while ($row = $result_finalizados->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_user'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['fecha_inico'] . '</td>';
                echo '<td>' . $row['fecha_fin'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">No hay manejo finalizado.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>