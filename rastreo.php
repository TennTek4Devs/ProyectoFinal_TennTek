<?php
session_start();

if(empty($_SESSION['id'])){
    header("Location: login.php");
}
?>

<title>BOLT</title>
<link rel="icon" href="./audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" type="image/png">
<link rel="stylesheet" href="./style/rastreo.css">

<body>
<header>
        <div class="logo"><a href=""><img src="audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" alt=""></a></div>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul class="nav">
                <li ><a href="index.php">Inicio</a></li>
                
            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </header>
    <section class="resent_order">
    <h2>Tus Envios en Progreso</h2>
    <table>
        <tr>
            <th>Paquete</th>
            <th>Cedula Destinatario</th>
            <th>Hora de Salida</th>
            <th>Acción</th>
        </tr>
        <?php
        // Conexión a la base de datos (ajusta los valores según tu configuración)
        include './assets/conexion.php';
        $ci = $_SESSION['ci'];
        // Consulta para obtener los envíos pendientes
        $sql_pendientes3 = "SELECT id_paquete, ci, nombre, peso, ciudad, direccion, mail, telefono FROM paquete WHERE ci = '$ci';";
        $result_pendientes3 = $conn->query($sql_pendientes3);

        if ($result_pendientes3->num_rows > 0) {
            while ($row = $result_pendientes3->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id_paquete'] . '</td>';
                echo '<td>' . $row['ci'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['peso'] . '</td>';
                echo '<td>' . $row['ciudad'] . '</td>';
                echo '<td>' . $row['direccion'] . '</td>';
                echo '<td>' . $row['mail'] . '</td>';
                echo '<td>' . $row['telefono'] . '</td>';
                echo '<td><form action="" method="post">';
                echo '<input type="hidden" name="id_paquete" value="' . $row['id_paquete'] . '">';
                echo '<input class="paquete" type="submit" name="enviar_envio" value="Rastrear">';
                echo '</form></td>';
                echo '</tr>';
            }

            if (isset($_POST['enviar_envio'])) {
                // Conexión a la base de datos (ajusta los valores según tu configuración)
                include './assets/conexion.php';
                $paqueteU = $_POST['id_paquete'];
                // Consulta para obtener los datos del paquete y su progreso
                $sql = "SELECT paquete.nombre, envio.progreso FROM paquete INNER JOIN envio ON paquete.id_paquete = envio.id_paquete WHERE paquete.id_paquete = $paqueteU";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // Crear tabla HTML
                    echo "<table>";
                    echo "<tr><th>Nombre del paquete</th><th>Progreso</th></tr>";
                    // Mostrar resultados
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["nombre"]."</td><td>".$row["progreso"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No se encontró el paquete.";
                } 
                $conn->close();
            }

        } else {
            echo '<tr><td colspan="5">No hay envíos pendientes.</td></tr>';
        }

        ?>
    </table>
    </section>

</body>