<?php
// Leer el archivo JSON de ./JSON/updtpaquete.json
$actualizar_paquete = json_decode(file_get_contents("./JSON/updtpaquetes.json"), true);

// Obtener el id_paquete a actualizar
$id_paquete = $actualizar_paquete["actualizar_paquete"];

// Leer el archivo JSON de ./JSON/paquetes.json
$paquetes = json_decode(file_get_contents("./JSON/paquetes.json"), true);

// Buscar el paquete que coincide con el id_paquete
foreach ($paquetes as $paquete) {
    if ($paquete["id_paquete"] == $id_paquete) {
        // Obtener los valores del paquete
        $id_lote = $paquete["id_lote"];
        $id_user = $paquete["id_user"];
        $ci = $paquete["ci"];
        $nombre = $paquete["nombre"];
        $peso = $paquete["peso"];
        $ciudad = $paquete["ciudad"];
        $direccion = $paquete["direccion"];
        $origen = $paquete["origen"];
        $mail = $paquete["mail"];
        $telefono = $paquete["telefono"];
        break;
    }
}

// Crear un formulario para actualizar los atributos del paquete
echo "<form action='./dashpaquetes.php' method='post'>";
echo "<input type='hidden' name='id_paquete' value='" . $paquete["id_paquete"] . "'>";
echo "<input type='hidden' name='id_lote' value='" . $paquete["id_lote"] . "'>";
echo "<input type='hidden' name='id_user' value='" . $paquete["id_user"] . "'>";
echo "<label for='ci'>CI:</label>";
echo "<input type='text' id='ci' name='ci' value='" . $ci . "'><br>";
echo "<label for='nombre'>Nombre:</label>";
echo "<input type='text' id='nombre' name='nombre' value='" . $nombre . "'><br>";
echo "<label for='peso'>Peso:</label>";
echo "<input type='text' id='peso' name='peso' value='" . $peso . "'><br>";
echo "<label for='ciudad'>Ciudad:</label>";
echo "<input type='text' id='ciudad' name='ciudad' value='" . $ciudad . "'><br>";
echo "<label for='direccion'>Dirección:</label>";
echo "<input type='text' id='direccion' name='direccion' value='" . $direccion . "'><br>";
echo "<label for='mail'>Mail:</label>";
echo "<input type='hidden' name='origen' value='" . $origen . "'>";
echo "<input type='email' id='mail' name='mail' value='" . $mail . "'><br>";
echo "<label for='telefono'>Teléfono:</label>";
echo "<input type='tel' id='telefono' name='telefono' value='" . $telefono . "'><br>";
echo "<input type='submit' name='enviar_actualizacion' value='Enviar'>";
echo "</form>";

?>