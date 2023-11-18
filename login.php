<?php
session_start();
$fecha = date('y,m,d');
?>


<?php

include 'assets/usuarios2.php';
// Obtener el contenido del archivo JSON
$json = file_get_contents('JSON/usuarios.json');

// Decodificar el archivo JSON en un array asociativo
$usuarios = json_decode($json, true);

// Verificar si el usuario ya existe
function verificar_usuario($usuario)
{
  global $usuarios;
  foreach ($usuarios as $u) {
    if ($u['usuario'] === $usuario) {
      return true;
    }
  }
  return false;
}

// Verificar si el correo electrónico ya existe
function verificar_correo($correo)
{
  global $usuarios;
  foreach ($usuarios as $u) {
    if ($u['email'] === $correo) {
      return true;
    }
  }
  return false;
}

// Verificar si los datos no están repetidos
function verificar_datos($usuario, $correo)
{
  if (verificar_usuario($usuario) || verificar_correo($correo)) {
    return false;
  }
  return true;
}

if (isset($_POST['registrarse_'])) {
  // Permitir el ingreso del usuario

  $fecha_actual = date('Y-m-d');

  if (verificar_datos($_POST['user'], $_POST['email'])) {
    // Código para añadir cliente

    // Obtener la fecha de nacimiento a partir del valor POST
    $fecha_nacimiento = $_POST['fechaX'];
    // Calcular la diferencia entre las dos fechas
    $diferencia = date_diff(date_create($fecha_nacimiento), date_create($fecha_actual));
    // Obtener la edad en años
    $edad = $diferencia->y;

    // Obtener la contraseña del valor POST
    $contragen = $_POST['contrase'];
    // Crear un hash de la contraseña utilizando password_hash()
    $hash = password_hash($contragen, PASSWORD_BCRYPT);

    $cedula_id = $_POST['ci'];

    $cliente = array();
    // Crear un array con los datos del formulario
    $cliente[] = array(
      'usuario' => $_POST['user'],
      'cedula' => $_POST['ci'],
      'contrasena' => $hash,
      'nombre' => $_POST['nombre'],
      'apellido' => $_POST['apellido'],
      'edad' => $edad,
      'email' => $_POST['email'],
      'telefono' => $_POST['telefono'],
      'tipo' => 'cliente'
    );

    // Codificar el array en formato JSON
    $json_cliente = json_encode($cliente);

    // Escribir la cadena JSON en un archivo
    file_put_contents('JSON/ingusuario.json', $json_cliente);

    include 'assets/insertarusuario.php';
    
  } else {
    //nada
  }
  echo "<meta http-equiv='refresh' content='0'>";
}
?>


<?php

// Obtener el contenido del archivo JSON
$json = file_get_contents('JSON/usuarios.json');

// Decodificar el archivo JSON en un array asociativo
$usuarios = json_decode($json, true);

// Verificar si se ha enviado información de inicio de sesión
if (isset($_POST['logearse_'])) {
  $usuario = $_POST['logusuario'];
  $contrasena = $_POST['logpassword'];

  // Verificar si los datos de inicio de sesión coinciden con los datos almacenados en el archivo JSON
  foreach ($usuarios as $u) {
    if ($u['usuario'] === $usuario && password_verify($contrasena, $u['contrasena'])) {
      // Iniciar la sesión
      $tipo = $u['tipo'];
      $_SESSION['tipo'] = $tipo;
      $funcion = $u['empleado_funcion'];
      $_SESSION['funcion'] = $funcion;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['id'] = $u['id_user'];
      $_SESSION['ci'] = $u['ci'];
      if ($tipo == "empresa") {
        header('Location: backoffice.php');
      } elseif ($tipo == "empleado" || $tipo == "admin") {
        if ($funcion == "Funcionario") {
          include 'assets/conexion.php';
          $fecha_actual66 = date("Y-m-d H:i:s");
          $sql = "INSERT INTO gestiona (id_user, h_ingreso, h_salida) VALUES ('', '$fecha_actual66', NULL)";
          if (mysqli_query($conn, $sql)) {

          } else {
            echo "Error al insertar datos: " . mysqli_error($conn);
          }
        }
        header('Location: backoffice.php');
      } elseif ($tipo == "cliente") {
        header('Location: index.php');
      }
      exit;
    }
  }
}
?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BOLT</title>
  <link rel="icon" href="./audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" type="image/png">
  <link rel="stylesheet" href="./style/styles.css" />
</head>

<body>
  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap forms-wrap-log">
          <form action="#" method="POST" autocomplete="off" class="sign-in-form">
            <div class="logo">
              <img src="./img/logo.png" alt="bolt" />
              <h4>Bolt</h4>
            </div>

            <div class="heading">
              <h2>Bienvenido</h2>
              <h6>¿No se encuentra registrado?</h6>
              <a href="#" class="toggle">Sign up</a>
            </div>

            <div class="actual-form">
              <div class="input-wrap">
                <input type="text" minlength="4" id="logusuario" name="logusuario" class="input-field" value=""
                  autocomplete="off" required />
                <label>Usuario</label>
              </div>

              <div class="input-wrap">
                <input type="password" minlength="4" id="logpassword" name="logpassword" class="input-field" value=""
                  autocomplete="off" required />
                <label>Contraseña</label>
              </div>

              <input type="submit" name="logearse_" value="Iniciar Sesion" class="sign-btn" />

            </div>
          </form>



          <form action="login.php" method="POST" autocomplete="off" class="sign-up-form">
            <div class="logo">
              <img src="./img/logo.png" alt="bolt" />
              <h4>Bolt</h4>
            </div>

            <div class="heading">
              <h2>Inicia ahora</h2>
              <h6>¿Ya estas registrado?</h6>
              <a href="#" class="toggle">Sign in</a>
            </div>

            <div class="actual-form">

              <div class="input-wrap">
                <input type="text" id="user" name="user" minlength="4" class="input-field" autocomplete="off"
                  required />
                <label>Usuario
                  <?php if (isset($_POST['registrarse_'])) {
                    if (verificar_usuario($_POST['user'])) {
                      echo ' [ERROR, USUARIO EXISTENTE]';
                    }
                  } ?>
                </label>
              </div>

              <div class="input-wrap">
                <input type="text" id="ci" name="ci" minlength="8" class="input-field" autocomplete="off" required />
                <label>CI
                  <?php if (isset($_POST['registrarse_'])) {
                    if (verificar_ci($_POST['ci'])) {
                      echo ' error, ya existe esta cedula.';
                    }
                  } ?>
                </label>
              </div>

              <div class="input-wrap">
                <input type="text" id="nombre" name="nombre" minlength="1" pattern="^[A-Za-z]+$" class="input-field"
                  autocomplete="off" required />
                <label>Nombre</label>
              </div>

              <div class="input-wrap">
                <input type="text" id="apellido" name="apellido" minlength="1" pattern="^[A-Za-z]+$" class="input-field"
                  autocomplete="off" required />
                <label>Apellido</label>
              </div>

              <div class="input-wrap">
                <input type="email" id="email" name="email" class="input-field" autocomplete="off" required />
                <label>Email
                  <?php if (isset($_POST['registrarse_'])) {
                    if (verificar_usuario($_POST['email'])) {
                      echo ' error, ya existe este correo.';
                    }
                  } ?>
                </label>
              </div>

              <div class="input-wrap">
                <input type="tel" id="telefono" name="telefono" pattern="[0]{1}[9]{1}[1-9]{1}[0-9]{3}[0-9]{3}"
                  class="input-field" autocomplete="off" not required />
                <label>Telefono</label>
              </div>

              <?php
              $fecha_actual = date('Y-m-d');
              // Obtener la fecha de hace 18 años
              $fecha_18_anios = date('Y-m-d', strtotime('-18 years', strtotime($fecha_actual)));
              // Obtener la fecha de hace 110 años
              $fecha_110_anios = date('Y-m-d', strtotime('-110 years', strtotime($fecha_actual)));
              ?>

              <div class="input-wrap">
                <input type="date" id="fechaX" name="fechaX" min="<?php echo $fecha_110_anios; ?>"
                  max="<?php echo $fecha_18_anios; ?>" class="input-field" autocomplete="off" required />
              </div>

              <div class="input-wrap">
                <input type="password" id="contrase" name="contrase" minlength="4" class="input-field"
                  autocomplete="off" required />
                <label>Contraseña</label>
              </div>

              <input type="submit" formtarget="_self" id="registroBTN" name="registrarse_" value="Registrarse"
                class="sign-btn" />

            </div>
          </form>
        </div>





        <div class="carousel">
          <div class="images-wrapper">
            <img src="./img/image1.png" class="image img-1 show" alt="" />
            <img src="./img/image2.png" class="image img-2" alt="" />
            <img src="./img/image3.png" class="image img-3" alt="" />
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h2>Numero 1 en logistica</h2>
                <h2>Equipo mas que calificado</h2>
                <h2>Velocidad inmediata</h2>
              </div>
            </div>

            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Javascript file -->

  <script src="./scripts/app.js"></script>
</body>

</html>