<?php
session_start();

// Verificar si $_SESSION['id'] está vacío
if (empty($_SESSION['id'])) {
   // Redirigir al usuario a login.php
   header("Location: login.php");
   exit();
}

// Verificar si $_SESSION['tipo'] es "cliente"
if ($_SESSION['tipo'] == "cliente") {
   // Redirigir al usuario a index.php
   header("Location: index.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BOLT</title>

   <link rel="icon" href="./audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" type="image/png">
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
   <link rel="stylesheet" href="style/styleBO.css">
</head>

<body>
   <div class="container">
      <aside>

         <div class="top">
            <div class="logo">
               <h2><img src="./img/logo.png" alt=""> <span class="danger">Bolt</span> </h2>
            </div>
            <div class="close" id="close_btn">
               <span class="material-symbols-sharp">
                  close
               </span>
            </div>
         </div>
         <!-- end top -->
         <div class="sidebar">

            <a href="backoffice.php">
               <span class="material-symbols-sharp">grid_view </span>
               <h3>Panel Inicial</h3>
            </a>
            
            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcionario'] == "funcionario") {
               // Mostrar el contenido para "empleado" o "admin" y $_SESSION['funcionario']
               echo '<a href="dashcliente.php">';
               echo '<span class="material-symbols-sharp">person_outline </span>';
               echo '<h3>Clientes</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin") {
               // Mostrar el contenido para "admin"
               echo '<a href="dashempresa.php">';
               echo '<span class="material-symbols-sharp">work </span>';
               echo '<h3>Empresas</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin") {
               // Mostrar el contenido para "admin"
               echo '<a href="dashempleado.php">';
               echo '<span class="material-symbols-sharp">engineering </span>';
               echo '<h3>Empleados</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['tipo'] == "empresa") {
               // Mostrar el contenido para "empresa" o "admin" y $_SESSION['funcionario']
               echo '<a href="dashpaquetes.php" class="active">';
               echo '<span class="material-symbols-sharp">package </span>';
               echo '<h3>Paquetes</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashlotes.php">';
               echo '<span class="material-symbols-sharp">inventory_2 </span>';
               echo '<h3>Lotes</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashalmacen.php">';
               echo '<span class="material-symbols-sharp">warehouse </span>';
               echo '<h3>Almacenes</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['funcion'] == "conductorMion" || $_SESSION['funcion'] == "conductorNeta") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario, conductorNeta y conductorMion']
               echo '<a href="dashenvio.php">';
               echo '<span class="material-symbols-sharp">orders </span>';
               echo '<h3>Envios</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['funcion'] == "conductorMion") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashcamion.php">';
               echo '<span class="material-symbols-sharp">local_shipping </span>';
               echo '<h3>Camiones</h3>';
               echo '</a>';
            } ?>

<?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['funcion'] == "conductorMion") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashmanejaMion.php">';
               echo '<span class="material-symbols-sharp">local_shipping </span>';
               echo '<h3>Camioneros</h3>';
               echo '</a>';
            } ?>



            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['funcion'] == "conductorNeta") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashcamioneta.php">';
               echo '<span class="material-symbols-sharp">airport_shuttle </span>';
               echo '<h3>Camionetas</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario" || $_SESSION['funcion'] == "conductorNeta") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashmanejaNeta.php">';
               echo '<span class="material-symbols-sharp">airport_shuttle </span>';
               echo '<h3>Conductores</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashrutas.php">';
               echo '<span class="material-symbols-sharp">timeline </span>';
               echo '<h3>Rutas</h3>';
               echo '</a>';
            } ?>

            <?php
            if ($_SESSION['tipo'] == "admin" || $_SESSION['funcion'] == "funcionario") {
               // Mostrar el contenido para "admin" y $_SESSION['funcionario']
               echo '<a href="dashtrayecto.php">';
               echo '<span class="material-symbols-sharp">location_searching </span>';
               echo '<h3>Trayecto</h3>';
               echo '</a>';
            } ?>

            <a href="#" onclick="document.getElementById('cerrar_sesion').submit();">
               <span class="material-symbols-sharp">logout </span>
               <h3>Cerrar sesión</h3>
            </a>

            <form id="cerrar_sesion" method="post" action="./assets/cerrarsesion.php">
               <input type="hidden" name="cerrar_sesion" value="1">
            </form>



         </div>

      </aside>
      <!-- --------------
        end asid
      -------------------- -->

      <!-- --------------
        start main part
      --------------- -->

      <main>
         <h1>Dashbord</h1>

         <div class="insights">


         </div>
         <!-- end insights -->
         <div class="recent_order">
            <h2>Actualizar Paquetes</h2>
            <?php
            if (isset($_POST["actualizar_paquete"])) {
               // Conectar a la base de datos
               include './assets/conexion.php';

               $actualizar_paquete = $_POST['actualizar_paquete'];

               $data = array('actualizar_paquete' => $actualizar_paquete);
               $json_data = json_encode($data);
               file_put_contents('./JSON/updtpaquetes.json', $json_data);

               // Cerrar la conexión
               $conn->close();
            }

            include './vista/updpaquetes.php';
            ?>
         </div>

      </main>
      <!------------------
         end main
        ------------------->

      <!----------------
        start right main 
      ---------------------->
      <div class="right">

         <div class="top">
            <button id="menu_bar">
               <span class="material-symbols-sharp">menu</span>
            </button>

            <div class="theme-toggler">
               <span class="material-symbols-sharp active">light_mode</span>
               <span class="material-symbols-sharp">dark_mode</span>
            </div>
            <div class="profile">
               <div class="info">
                  <p><b><?php echo $_SESSION['usuario']; ?></b></p>
                  <p><?php echo $_SESSION['tipo']; ?></p>
                  <small class="text-muted"></small>
               </div>
               <div class="profile-photo">
                  <img src="./img/profile-1.jpg" alt="" />
               </div>
            </div>
         </div>




         <script src="scripts/script.js"></script>
</body>

</html>