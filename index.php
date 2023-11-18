<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Tomas Lescano, Santiago Lorenzo, Leandro Ugarte y Salvador Pereira">

  <link rel="icon" href="./audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" type="image/png">
  <link rel="stylesheet" href="./Styles/style.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/gsap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>BOLT</title>
</head>

<body>
  <header>
    <div class="logo"><a href=""><img src="audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" alt=""></a></div>
    <input type="checkbox" id="nav_check" hidden>
    <nav>
      <ul class="nav">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Nosotros.html">Nosotros</a></li>
        <li><a href="servicios.html">Servicios</a></li>
        <li><a href="contacto.html">Contacto</a></li>
        <?php
        // Verificar si $_SESSION['id'] no está setteado
        if (empty($_SESSION['id'])) {
          // Mostrar esto
          echo "<li class='nav__item'><a href='login.php'>Iniciar sesion</a></li>";
        } else {
          // Mostrar lo otro
          echo "<li class='nav__item'><a href='./assets/cerrarsesion.php'>Cerrar Sesion</a></li>";
        }
        ?>
      </ul>
    </nav>
    <label for="nav_check" class="hamburger">
      <div></div>
      <div></div>
      <div></div>
    </label>
  </header>

  <section class="hero">
    <div class="content">
      <h2>BOLT</h2>
    </div>
    <div class="waves"></div>
  </section>


  <section class="section__container explore__container" id="principales">
    <div class="container__trust container__card-primary">
      <div class="trust card__primary">
        <div class="text__trust text__card-primary">
          <p>A un click de velocidad</p>
          <h1>Con solo un click</h1>
        </div>
          <div class="card__trust box__card-primary" id="rastreo">
            <a href="rastreo.php">
            <img src="./audiovisual/rastreo.png" alt="">
            <h2>Rastreo</h2>
            </a>
          </div>
        </div>
        <!-- Tr -->
      </div>
    </div>

  </section>


  <!-- super -->
  <section id="second-sec">
    <div class="slider">
      <div class="slide active">
        <img src="./audiovisual/campo.png" alt="">
        <div class="info">
          <h2>Hasta cualquier parte</h2>
          <p>Con ayuda de nuestro equipo especializado y la flota con la que contamos nos sentimos orgullosos de decir
            que le llevamos el paquete a cualquier parte del pais</p>
        </div>
      </div>
      <div class="slide">
        <img src="./audiovisual/team.png" alt="">
        <div class="info">
          <h2>Desempeño de equipo </h2>
          <p>Contamos con un equipo especializado en logistica y transporte con un respaldo de 300 profecionales
            comprometidos con la vision de la empresa</p>
        </div>
      </div>
      <div class="slide">
        <img src="./audiovisual/reloj.png" alt="">
        <div class="info">
          <h2>En tiempo</h2>
          <p>Pueden contar con nosotros para que cualquier pedido llegue en fecha y hora sin inconvenientes</p>
        </div>
      </div>
      <div class="slide">
        <img src="./audiovisual/almacen.png" alt="">
        <div class="info">
          <h2>Sucursales</h2>
          <p>Contamos con al menos 1 almacen por departapento teniendo mas de 30 sucursales estrategicamente ubicadas a
            lo largo y ancho del pais</p>
        </div>
      </div>
      <div class="slide">
        <img src="./audiovisual/repartidor.png" alt="">
        <div class="info">
          <h2>Un toque personal</h2>
          <p>En Bolt, nos enorgullece no solo entregar tus envíos a tiempo, sino hacerlo con un toque personal y amable
            que marca la diferencia. Creemos que el servicio al cliente comienza en la puerta de tu hogar.</p>
        </div>
      </div>
      <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
      </div>
      <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
      </div>
    </div>
  </section>


  <!-- footer -->


  <footer class="footer-distributed">

    <div class="footer-left">
      <h3><span>Bolt</span><img src="audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" alt="Bolt"></h3>

      <p class="footer-links">
        <a href="index.html">Inicio</a>
        |
        <a href="Nosotros.html">Nosotros</a>
        |
        <a href="servicios.html">Servicios</a>
        |
        <a href="contacto.html">Contacto</a>
      </p>
      <p class="footer-company-name">Copyright © 2023 <strong>TennTek</strong> All rights reserved</p>
    </div>

    <div class="footer-center">
      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Ubicacion</span>
          Blvr 26 de Marzo 3438 esq Marco Bruto</p>
      </div>

      <div>
        <i class="fa fa-phone"></i>
        <p>+598 920 636 38</p>
      </div>
      <div>
        <i class="fa fa-envelope"></i>
        <p><a href="santilorenzo1640@gmail.com">supptenntek@gmail.com</a></p>
      </div>
    </div>
    <div class="footer-right">
      <p class="footer-company-about">
        <span>Sobre nosotros</span>
        <strong>Bolt</strong> es una empresa de logística y envíos que forma parte del Grupo QuickCarry, una entidad con
        una sólida trayectoria en el mundo del transporte y la distribución.
      </p>
      <div class="footer-icons">
        <span class="es"><img src="audiovisual/bandera_esp.png"></span>
        <input type="checkbox" class="check">
        <span class="en"><img src="audiovisual/bandera_eng.png"></span>
      </div>
    </div>
  </footer>
  <script src="./Scripts/script2.js"></script>
  <script src="./Scripts/idioma1.js"></script>
</body>

</html>