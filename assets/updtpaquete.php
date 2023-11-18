<?php
// Leer el archivo JSON de ./JSON/updtpaquetes.json
$actualizar_paquete = json_decode(file_get_contents("./JSON/updtpaquetes.json"), true);

// Obtener los datos del paquete a actualizar
$id_paquete = $actualizar_paquete["id_paquete"];
$id_lote = $actualizar_paquete["id_lote"];
$id_user = $actualizar_paquete["id_user"];
$ci = $actualizar_paquete["ci"];
$nombre = $actualizar_paquete["nombre"];
$peso = $actualizar_paquete["peso"];
$ciudad = $actualizar_paquete["ciudad"];
$direccion = $actualizar_paquete["direccion"];
$origen = $actualizar_paquete["origen"];
$mail = $actualizar_paquete["mail"];
$telefono = $actualizar_paquete["telefono"];

// Conectar con la base de datos
include 'conexion.php';

// Verificar si la conexión fue exitosa
if ($conn) {
    // Crear la consulta SQL para actualizar el paquete
    $sql = "UPDATE paquete SET id_lote = '$id_lote', id_user = '$id_user', ci = '$ci', nombre = '$nombre', peso = '$peso', ciudad = '$ciudad', direccion = '$direccion', origen = '$origen', mail = '$mail', telefono = '$telefono' WHERE id_paquete = '$id_paquete'";

    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar si la consulta fue exitosa
    if ($resultado) {
        echo "El paquete se actualizó correctamente.";
    } else {
        echo "Ocurrió un error al actualizar el paquete.";
    }

    // Cerrar la conexión
    mysqli_close($conn);
} else {
    echo "No se pudo conectar con la base de datos.";
}
?>