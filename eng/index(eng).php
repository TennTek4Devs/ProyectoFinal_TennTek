<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Tomas Lescano, Santiago Lorenzo, Leandro Ugarte y Salvador Pereira">

  <link rel="icon" href="../audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" type="image/png">
  <link rel="stylesheet" href="../Styles/style.css">
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
    <div class="logo"><a href=""><img src="../audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" alt=""></a></div>
    <input type="checkbox" id="nav_check" hidden>
    <nav>
      <ul class="nav">
        <li><a href="index(eng).php">Home</a></li>
        <li><a href="Nosotros(eng).html">About us</a></li>
        <li><a href="servicios(eng).html">Services</a></li>
        <li><a href="contacto(eng).html">Contact us</a></li>
        <?php
        if (!isset($_SESSION['id'])) {
          // Mostrar esto
          echo "<li class='nav__item'><a href='../login.php'>Log In</a></li>";
        } else {
          // Mostrar lo otro
          echo "<li class='nav__item'><a href='../assets/cerrarsesion.php'>Log Out</a></li>";
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
          <p>at the speed of a click</p>
          <h1>With only one click</h1>
        </div>
          <div class="card__trust box__card-primary" id="rastreo">
            <a href="../rastreo.php">
            <img src="../audiovisual/rastreo.png" alt="">
            <h2>Tracking</h2>
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
        <img src="../audiovisual/campo.png" alt="">
        <div class="info">
          <h2>To anywhere</h2>
          <p>With the help of our specialized team and the fleet we have, we are proud to say that we take the package
            to any part of the country.</p>
        </div>
      </div>
      <div class="slide">
        <img src="../audiovisual/team.png" alt="">
        <div class="info">
          <h2>Team performance </h2>
          <p>We have a team specialized in logistics and transportation with the support of 300 professionals committed
            to the company's vision.</p>
        </div>
      </div>
      <div class="slide">
        <img src="../audiovisual/reloj.png" alt="">
        <div class="info">
          <h2>In time</h2>
          <p>You can count on us to ensure that any order arrives on the date and time without any inconvenience.</p>
        </div>
      </div>
      <div class="slide">
        <img src="../audiovisual/almacen.png" alt="">
        <div class="info">
          <h2>Branch offices</h2>
          <p>We have at least 1 warehouse per department, having more than 30 branches strategically located throughout
            the country.</p>
        </div>
      </div>
      <div class="slide">
        <img src="../audiovisual/repartidor.png" alt="">
        <div class="info">
          <h2>A personal touch</h2>
          <p>At Bolt, we take pride in not only delivering your shipments on time, but doing so with a personal and
            friendly touch that makes all the difference. We believe that customer service begins at your doorstep.</p>
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
      <h3><span>Bolt</span><img src="../audiovisual/Nuevo_logo_caja-_1_-removebg-preview.png" alt="Bolt"></h3>

      <p class="footer-links">
        <a href="index(eng).html">Home</a>
        |
        <a href="Nosotros(eng).html">About us</a>
        |
        <a href="servicios(eng).html">Services</a>
        |
        <a href="contacto(eng).html">Contact us</a>
      </p>

      <p class="footer-company-name">Copyright © 2023 <strong>TennTek</strong> All rights reserved</p>
    </div>

    <div class="footer-center">
      <div>
        <i class="fa fa-map-marker"></i>
        <p><span>Location</span>
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
        <span>About Us</span>
        <strong>Bolt</strong> is a logistics and shipping company that is part of the QuickCarry Group, an entity with a
        solid track record in the world of transportation and distribution.
      </p>
      <div class="footer-icons">
        <span class="es"><img src="../audiovisual/bandera_esp.png"></span>
        <input type="checkbox" class="check" checked>
        <span class="en"><img src="../audiovisual/bandera_eng.png"></span>
      </div>
    </div>
  </footer>
  <script src="../Scripts/script.js"></script>
  <script src="../Scripts/idioma1.js"></script>
</body>