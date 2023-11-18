<!DOCTYPE html>
<html>



<?php
// Verificar si $_SESSION['funcionario'] está setteado
if ($_SESSION['funcion'] == "funcionario" || $_SESSION['tipo'] == "admin") {
    // Mostrar el formulario de envío
    echo '<body>

    <form class="form-almacen" action="" method="post">
        <div class="select-wrap">
            <label for="id_paquete">ID Paquete:</label>
            <select name="id_paquete" id="id_paquete">';
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';
    // Consulta para obtener los paquetes sin envío
    $sql_paquetes = "SELECT id_paquete FROM paquete WHERE id_paquete NOT IN (SELECT id_paquete FROM envio)";
    $result_paquetes = $conn->query($sql_paquetes);
    if ($result_paquetes->num_rows > 0) {
        while ($row = $result_paquetes->fetch_assoc()) {
            echo '<option value="' . $row['id_paquete'] . '">' . $row['id_paquete'] . '</option>';
        }
    } else {
        echo '<option value="">No hay paquetes disponibles.</option>';
    }
    $conn->close();
    echo '</select>
</div>
<br><br>
<div class="select-wrap">
<label for="matricula">Matrícula:</label>
<select name="matricula" id="matricula">';
    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';
    //Consulta para obtener las matrículas de camioneta
    $sql_camionetas = "SELECT matricula FROM camioneta";
    $result_camionetas = $conn->query($sql_camionetas);
    while ($row = $result_camionetas->fetch_assoc()) {
        echo '<option value="' . $row['matricula'] . '">' . $row['matricula'] . '</option>';
    }
    $conn->close();
    echo '</select>
</div>
<br><br>
<input class="enviar" type="submit" name="input_envio" value="Enviar">
    </form>
</body>';
} else {
    // Mostrar una tabla con el único resultado de "Inicia sesión para ver más información."
    echo "<table>";
    echo "<tr><td>Inicia sesión como funcionario para ver más información.</td></tr>";
    echo "</table>";
}
?>

</html>

<?php
if (isset($_POST['input_envio'])) {
    // Obtener los valores seleccionados
    $id_paquete = $_POST['id_paquete'];
    $matricula = $_POST['matricula'];

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Obtener la fecha actual
    $fecha_actual = date("Y-m-d H:i:s");

    // Consulta para insertar en la tabla envio
    $sql_insert = "INSERT INTO envio (id_paquete, matricula, progreso, h_salida, h_llegada) VALUES ('$id_paquete', '$matricula', 'En Almacen', '$fecha_actual', NULL)";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Envíos Pendientes</h2>
    <table>
        <tr>
            <th>ID Paquete</th>
            <th>Matrícula</th>
            <th>Progreso</th>
            <th>Hora de Salida</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los envíos pendientes
        $sql_pendientes = "SELECT * FROM envio WHERE progreso = 'En Almacen'";
        $result_pendientes = $conn->query($sql_pendientes);

        if ($result_pendientes->num_rows > 0) {
            while ($row = $result_pendientes->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_paquete'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['progreso'] . '</td>';
                echo '<td>' . $row['h_salida'] . '</td>';
                echo '<td><form action="" method="post">';
                echo '<input type="hidden" name="id_paquete" value="' . $row['id_paquete'] . '">';
                echo '<input class="paquete" type="submit" name="cargar_envio" value="Cargar">';
                echo '</form></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay envíos pendientes.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
if (isset($_POST['cargar_envio'])) {
    // Obtener el ID de paquete desde el formulario
    $id_paquete = $_POST['id_paquete'];

    // Obtener la fecha actual
    $fecha_actual = date("Y-m-d H:i:s");

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para actualizar la fecha de llegada
    $sql_update1 = "UPDATE envio SET progreso = 'Cargando' WHERE id_paquete = '$id_paquete'";

    if ($conn->query($sql_update1) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error al actualizar la fecha de llegada: " . $conn->error;
    }

    $conn->close();
}
?>

<body>
    <h2>Envíos en Carga</h2>
    <table>
        <tr>
            <th>ID Paquete</th>
            <th>Matrícula</th>
            <th>Progreso</th>
            <th>Hora de Salida</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los envíos pendientes
        $sql_pendientes2 = "SELECT * FROM envio WHERE progreso = 'Cargando'";
        $result_cargados2 = $conn->query($sql_pendientes2);

        if ($result_cargados2->num_rows > 0) {
            while ($row = $result_cargados2->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_paquete'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['progreso'] . '</td>';
                echo '<td>' . $row['h_salida'] . '</td>';
                echo '<td><form action="" method="post">';
                echo '<input type="hidden" name="id_paquete" value="' . $row['id_paquete'] . '">';
                echo '<input class="paquete" type="submit" name="entregar_envio" value="Transportar">';
                echo '</form></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay envíos pendientes.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>

<?php
if (isset($_POST['entregar_envio'])) {
    // Obtener el ID de paquete desde el formulario
    $id_paquete = $_POST['id_paquete'];

    // Obtener la fecha actual
    $fecha_actual = date("Y-m-d H:i:s");

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para actualizar la fecha de llegada
    $sql_update2 = "UPDATE envio SET progreso = 'Transportando' WHERE id_paquete = '$id_paquete'";

    if ($conn->query($sql_update2) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error al actualizar la fecha de llegada: " . $conn->error;
    }

    $conn->close();
}
?>

<body>
    <h2>Envíos en Camino</h2>
    <table>
        <tr>
            <th>ID Paquete</th>
            <th>Matrícula</th>
            <th>Progreso</th>
            <th>Hora de Salida</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los envíos pendientes
        $sql_pendientes3 = "SELECT * FROM envio WHERE progreso = 'Transportando'";
        $result_pendientes3 = $conn->query($sql_pendientes3);

        if ($result_pendientes3->num_rows > 0) {
            while ($row = $result_pendientes3->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_paquete'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['progreso'] . '</td>';
                echo '<td>' . $row['h_salida'] . '</td>';
                echo '<td><form action="" method="post">';
                echo '<input type="hidden" name="id_paquete" value="' . $row['id_paquete'] . '">';
                echo '<input class="paquete" type="submit" name="enviar_envio" value="Entregar">';
                echo '</form></td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay envíos pendientes.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

<?php
if (isset($_POST['enviar_envio'])) {
    // Obtener el ID de paquete desde el formulario
    $id_paquete = $_POST['id_paquete'];

    // Obtener la fecha actual
    $fecha_actual = date("Y-m-d H:i:s");

    // Conexión a la base de datos (ajusta los valores según tu configuración)
    include './assets/conexion.php';

    // Consulta para actualizar la fecha de llegada
    $sql_update2 = "UPDATE envio SET h_llegada = '$fecha_actual', progreso = 'Entregado' WHERE id_paquete = '$id_paquete'";

    if ($conn->query($sql_update2) === TRUE) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error al actualizar la fecha de llegada: " . $conn->error;
    }

    $conn->close();
}
?>

<body>
    <h2>Envíos Completados</h2>
    <table>
        <tr>
            <th>ID Paquete</th>
            <th>Matrícula</th>
            <th>Progreso</th>
            <th>Hora de Salida</th>
            <th>Hora de Llegada</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';

        // Consulta para obtener los registros con fecha_fin distinta de null
        $sql_finalizados = "SELECT * FROM envio WHERE progreso = 'Entregado'";
        $result_finalizados = $conn->query($sql_finalizados);

        if ($result_finalizados->num_rows > 0) {
            while ($row = $result_finalizados->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_paquete'] . '</td>';
                echo '<td>' . $row['matricula'] . '</td>';
                echo '<td>' . $row['progreso'] . '</td>';
                echo '<td>' . $row['h_salida'] . '</td>';
                echo '<td>' . $row['h_llegada'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No hay envios finalizados.</td></tr>';
        }

        $conn->close();
        ?>
    </table>
</body>

</html>