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

            <a href="backoffice.php" class="active">
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
               echo '<a href="dashpaquetes.php">';
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

         <?php
         // Conectarse a la base de datos
         include './assets/conexion.php';

         // Ejecutar una consulta para contar las filas
         $sql = "SELECT COUNT(*) FROM paquete";
         $resultado = mysqli_query($conn, $sql);
         // Obtener el número de filas
         $filas_paquetes = mysqli_fetch_array($resultado)[0];

         $sql2 = "SELECT COUNT(*) FROM almacen";
         $resultado2 = mysqli_query($conn, $sql2);
         // Obtener el número de filas
         $filas_almacenes = mysqli_fetch_array($resultado2)[0];

         $sql5 = "SELECT COUNT(*) FROM lotes";
         $resultado5 = mysqli_query($conn, $sql5);
         // Obtener el número de filas
         $filas_lotes = mysqli_fetch_array($resultado5)[0];

         $sql3 = "SELECT COUNT(*) FROM usuario";
         $resultado3 = mysqli_query($conn, $sql3);
         // Obtener el número de filas
         $filas_usuarios = mysqli_fetch_array($resultado3)[0];

         $sql4 = "SELECT COUNT(*) FROM empresa";
         $resultado4 = mysqli_query($conn, $sql4);
         // Obtener el número de filas
         $filas_empresa = mysqli_fetch_array($resultado4)[0];

         $sql6 = "SELECT COUNT(*) FROM empleado";
         $resultado6 = mysqli_query($conn, $sql6);
         // Obtener el número de filas
         $filas_empleado = mysqli_fetch_array($resultado6)[0];

         $sql7 = "SELECT COUNT(*) FROM envio";
         $resultado7 = mysqli_query($conn, $sql7);
         // Obtener el número de filas
         $filas_envios = mysqli_fetch_array($resultado7)[0];

         $sql8 = "SELECT COUNT(*) FROM (SELECT * FROM camion
                                       UNION
                                       SELECT * FROM camioneta) AS filas";
         $resultado8 = mysqli_query($conn, $sql8);
         // Obtener el número de filas
         $filas_vehiculos = mysqli_fetch_array($resultado8)[0];

         $sql9 = "SELECT COUNT(*) FROM (SELECT * FROM conductorNeta
                                       UNION
                                       SELECT * FROM conductorMion) AS filas";
         $resultado9 = mysqli_query($conn, $sql9);
         // Obtener el número de filas
         $filas_conductores = mysqli_fetch_array($resultado9)[0];

         // Cerrar la conexión
         mysqli_close($conn);
         ?>

         <div class="recent_order">
            <h2>Panel Inicial</h2>

            <div class="insights">

               <!-- start seling -->
               <div class="income">
                  <span class="material-symbols-sharp">work </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Empresas</h3>
                        <h1>
                           <?php echo $filas_empresa; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Empresas en Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start expenses -->
               <div class="income">
                  <span class="material-symbols-sharp">person_outline </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Usuarios</h3>
                        <h1>
                           <?php echo $filas_usuarios; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Usuarios de Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start seling -->
               <div class="income">
                  <span class="material-symbols-sharp">engineering </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Empleados</h3>
                        <h1>
                           <?php echo $filas_empleado; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Empleados en Bolt</small>
               </div>
               <!-- end seling -->

            </div>
            <!-- end insights -->

            <div class="insights">

               <!-- start seling -->
               <div class="sales">
                  <span class="material-symbols-sharp">package </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Paquetes</h3>
                        <h1>
                           <?php echo $filas_paquetes; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Paquetes en Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start expenses -->
               <div class="sales">
                  <span class="material-symbols-sharp">warehouse </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Almacenes</h3>
                        <h1>
                           <?php echo $filas_almacenes; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Almacenes en Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start seling -->
               <div class="sales">
                  <span class="material-symbols-sharp">inventory_2 </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Lotes</h3>
                        <h1>
                           <?php echo $filas_lotes; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Lotes en Bolt</small>
               </div>
               <!-- end seling -->

            </div>
            <!-- end insights -->
            <div class="insights">

               <!-- start seling -->
               <div class="expenses">
                  <span class="material-symbols-sharp">orders </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Envios</h3>
                        <h1>
                           <?php echo $filas_envios; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Envios en Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start expenses -->
               <div class="expenses">
                  <span class="material-symbols-sharp">directions_car </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Vehiculos</h3>
                        <h1>
                           <?php echo $filas_vehiculos; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Vehiculos en Bolt</small>
               </div>
               <!-- end seling -->
               <!-- start seling -->
               <div class="expenses">
                  <span class="material-symbols-sharp">badge </span>
                  <div class="middle">

                     <div class="left">
                        <h3>Total de Conductores</h3>
                        <h1>
                           <?php echo $filas_conductores; ?>
                        </h1>
                     </div>

                  </div>
                  <small>Conductores en Bolt</small>
               </div>
               <!-- end seling -->

            </div>
            <!-- end insights -->

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
                  <p><b>
                        <?php echo $_SESSION['usuario']; ?>
                     </b></p>
                  <p>
                     <?php echo $_SESSION['tipo']; ?>
                  </p>
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