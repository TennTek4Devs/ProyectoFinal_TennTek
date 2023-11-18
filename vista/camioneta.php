<form class="form-almacen" method="POST" action="">
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" id="matricula" pattern="^[A-S][T][P][0-9]{4}$" required><br><br>
    
    <div class="select-wrap">
    <label for="estado">Estado:</label>
    <select name="estado" id="estado" required>
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
    </select><br><br><br>
    </div>

    <label for="capacidad">Capacidad:</label>
    <input type="number" name="capacidad" id="capacidad" min="1000" max="5000" required><br><br>

    <label for="marca">Marca:</label>
    <input type="text" name="marca" id="marca" required><br><br>

    <label for="modelo">Modelo:</label>
    <input type="text" name="modelo" id="modelo" required><br><br>

    <input class="enviar" type="submit" name="enviar_camioneta" value="Enviar">
</form>

<?php
if (isset($_POST['enviar_camioneta'])) {
    $matricula = $_POST['matricula'];
    $estado = $_POST['estado'];
    $capacidad = $_POST['capacidad'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];

    // Conexión a la base de datos y ejecución de la consulta INSERT
    include './assets/conexion.php';

    $consulta = "INSERT INTO camioneta (matricula, estado, capacidad, marca, modelo) VALUES ('$matricula', '$estado', $capacidad, '$marca', '$modelo')";
    $conn->query($consulta);
    $conn->close();
}
?>

<?php
include './assets/conexion.php';
$consulta = "SELECT * FROM camioneta";
$resultado = $conn->query($consulta);
?>

<table>
    <tr>
        <th>Matrícula</th>
        <th>Estado</th>
        <th>Capacidad</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Acciones</th>
    </tr>

    <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td>
                <?php echo $fila['matricula']; ?>
            </td>
            <td>
                <?php echo $fila['estado']; ?>
            </td>
            <td>
                <?php echo $fila['capacidad']; ?>
            </td>
            <td>
                <?php echo $fila['marca']; ?>
            </td>
            <td>
                <?php echo $fila['modelo']; ?>
            </td>
            <td>
                <form method="POST" action="">
                    <input type="hidden" name="matricula" value="<?php echo $fila['matricula']; ?>">
                    <input type="submit" name="eliminar_camioneta" value="Eliminar">
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php
// Eliminación de filas
if (isset($_POST['eliminar_camioneta'])) {
    $matricula = $_POST['matricula'];
    $consulta = "DELETE FROM camioneta WHERE matricula = '$matricula'";
    $conn->query($consulta);
    $conn->close();
    echo "<meta http-equiv='refresh' content='0'>";
}
?>