<?php
session_start();
require "config.php";

// var_dump($_SESSION['level']);
// exit;
  if(isset ($_COOKIE['id']) && isset ($_COOKIE['username'])) {
    $id = $_COOKIE['id'];
    $username = $_COOKIE['username'];

    $result = mysqli_query($conn, "SELECT * FROM users where id = $id");
    $row = mysqli_fetch_assoc($result);

    $hashed = md5($row['username']);

    if($username === $hashed) {
      $_SESSION['level'] = $row['level'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['nama'] = $row['name'];
      $nama = $_SESSION['nama'];
    }
  }

  if(isset ($_SESSION['level'])) {
    $level = $_SESSION['level'];
      if($level == "admin") {
        header('location: admin/home.php');
      }
      elseif($level == "dosen") {
        header('location: dosen/home.php');
      }
      elseif($level == "mahasiswa") {
        header('location: mahasiswa/home.php');
      } echo "Tidak mengenali sesi.";
  }   

  // var_dump($level);
  // exit;

// include "navbar.php";
// include "carousel.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" sizes="16x16" href="images/star.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Database Akademik NPS University</title>
  </head>
  <body>

    <section id="navbar">
      <div class="container">

      <div class="navbar">
        <div class="logo">
          <img src="images/logo1.png" width="250px">
        </div>
        <nav>
          <ul id="MenuItems">
            <li><a href="" class="navlink">Home</a></li>
            <li><a href="#foto" class="navlink">Gallery</a></li>
            <li><a href="#databases" class="navlink">Databases</a></li>
            <li><a href="#about"class="navlink">About Us</a></li>
          </ul>
        </nav>
            <button class="btn nav-btn-primary" onclick="document.location.href='login.php'"><i class="fa fa-sign-in"></i>Login</button>
            <i class="fa fa-bars menu-icon" onclick="menutoggle()"></i>        
      </div>

      <div class="nav-row">
        <div class="column-2">
          <h1>Database Akademik NPS University</h1>
          <p class="subtitle">Education is the most powerful weapon which you can use to change the world</p>
          <p class="d-flex justify-content-end">&#8212; Nelson Mandela</p>
          <a href="#databases" class="nav-btn btn-primary">Explore Now &#8594;</a>
        </div>
        <div class="column-2">
          <img src="images/content4.png">
        </div>
      </div>

      </div>
    </section>

    <section id="foto">

    <div class="small-container">
      <h2 class="title">Galeri</h2>
      <div class="baris">
        <div class="column-3">
          <img src="images/home2.jpg">
        </div>
        <div class="column-3">
          <img src="images/home3.jpg">
        </div>
        <div class="column-3">
          <img src="images/home4.jpg">
        </div>
      </div>
    </div>
  </section>

  <section id="quote">
    <div class="container">
      <div class="baris">
        <div class="kolom-2">
        <i class="fa fa-quote-left"></i>
        <h3>Keep away from people who try to belittle your ambitions. Small people always do that, but the really great make you feel that you, too, can become great.</h3>
        <i class="fa fa-quote-right d-flex justify-content-end"></i>
        <h5 class="d-flex justify-content-end">&#8212; Mark Twain</h5>
        </div>
        <div class="kolom-2">
        <img src="images/home1.png">  
        </div>
      </div>
    </div>
    </section>

    <section id="databases">
      <div class="small-container">
        <h2 class="title mt">Basis Data</h2>

          <div class="baris">
      <div class="databases-col">
        <div class="wrapper">
        <img src="images/content1.png" class="img1">
        <h4> Database Mahasiswa </h4>
        <p>Data NIM, Nama, Tanggal Lahir, Alamat, <br> dan Jenis Kelamin Mahasiswa</p>
      <button class="btn btn-primary" onclick="document.location.href='login.php'">Detail &#8594;</button>
        </div>
      </div>

      <div class="databases-col">
        <div class="wrapper">
        <img src="images/content2.png" class="img2">
        <h4> Database Dosen </h4>
        <p>Data NIP dan Nama Dosen</p>
      <button class="btn btn-primary" onclick="document.location.href='login.php'">Detail &#8594;</button>
        </div>
      </div>
        </div>

        <div class="baris">
      <div class="databases-col">
        <div class="wrapper">
        <img src="images/content3.png" class="img1">
        <h4> Database Mata Kuliah </h4>
        <p>Data Kode Mata Kuliah, Nama Mata Kuliah, dan SKS</p>
      <button class="btn btn-primary" onclick="document.location.href='login.php'">Detail &#8594;</button>
        </div>
      </div>
      <div class="databases-col">
        <div class="wrapper">
        <img src="images/content12.png" class="img3">
        <h4> Database Perkuliahan </h4>
        <p>Data NIM, Kode Mata Kuliah, NIP, SKS, dan Nilai Mahasiswa</p>
      <button class="btn btn-primary" onclick="document.location.href='login.php'">Detail &#8594;</button>
        </div>
      </div>
        </div>

      </div>
    </section>

  <section id="quote">
    <div class="container">
      <div class="baris">
        <div class="kolom-2">
        <img src="images/home2.png">  
        </div>
        <div class="kolom-2">
        <i class="fa fa-quote-left"></i>
        <h3>If a man empties his purse into his head, no man can take it away from him. An investment in knowledge always pays the best interest.</h3>
        <i class="fa fa-quote-right d-flex justify-content-end"></i>
        <h5 class="d-flex justify-content-end">&#8212; Ben Franklin</h5>
        </div>
      </div>
    </div>
    </section>

    <section id="about">
      <div class="small-container">
        <h2 class="title">Tentang Kami</h2>
        <div class="baris">

          <div class="kolom-3">
            <i class="fa fa-quote-left"></i>
            <p class="nama">Nur Azzizah</p>
            <img src="images/girl1.png" class="img">
            <p>M0719080</p>
          </div>
          <div class="kolom-3">
            <i class="fa fa-quote-left"></i>
            <p class="nama">Priska Sabila Putri</p>
            <img src="images/girl2.png" class="img">
            <p>M0719082</p>
          </div>
          <div class="kolom-3">
            <i class="fa fa-quote-left"></i>
            <p class="nama">Shelomita Puspa<br>Dara Kinanti</p>
            <img src="images/girl3.png" class="img2">
            <p>M0719096</p>
          </div>

        </div>
      </div>
    </section>

    <section id="footer">
      <div class="footer">
        <div class="container">
          <div class="baris2">
        <div class="footer-logo">
          <img src="images/logo1.png" width="150px">
        </div>
        <p class="footer-p"> &copy; Copyright 2020 | NPS University | Sistem Informasi Manajemen B</p>
          </div>
        </div>
      </div>
    </section>


    <script type="text/javascript">
      var MenuItems = document.getElementById("MenuItems");
      MenuItems.style.maxHeight = "0px";
      function menutoggle() {
        if(MenuItems.style.maxHeight == "0px") {
          MenuItems.style.maxHeight = "200px";
        } else {
          MenuItems.style.maxHeight = "0px";
        }
      }
    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>