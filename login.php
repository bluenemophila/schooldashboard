<?php

session_start();
require "config.php";

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
    // var_dump($row);
    // exit;

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
  <body class="login-page">

    <section id="login">
    <div class="container text-center mb-4">

      <div class="baris">

      <div class="kolom-2">
        <div class="d-flex justify-content-start mb-3"><a href="index.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left mr-5"></i>  Kembali</a></div>
        <img src="images/login.png">
        <h5 class="d-flex"><i class="fa fa-quote-left"></i>Live as if you were to die tomorrow.<br>Learn as if you were to live forever.<i class="fa fa-quote-right"></i></h5>
        <h6 class="d-flex justify-content-end">&#8212; Mahatma Gandhi</h6>
      </div>

      <div class="kolom-2">
        <div class="wrap">
      <h1 class="text-center gradient-text"> <i class="fa fa-university"> </i></h1>
      <h4 class="text-center">Login</h4> <br>

      <form method="post" action="cek_login.php">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" placeholder="Username" name="username" required autocomplete="off">
            <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          <label for="password">Password</label>
        </div> </br>
          <div class="form-floating mb-3">
          <select class="form-select" name="level" id="level" aria-label="Pilih Level" name="level" required>
            <option selected>Pilih Level</option>
            <option value ="mahasiswa">Mahasiswa</option>
            <option value ="dosen">Dosen</option>
            <option value= "admin">Admin</option>
          </select>
          <label for="level">Level</label>
        </div>
        <br>
        <div class="form-check align-left d-flex flex-row">
      <input class="form-check-input" type="checkbox" id="remember" name="remember">
      <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <br>
        <button type="submit" name="login" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i>Login</button>

    </form>
      <br>
      <p> Belum memiliki akun? Registrasi <a href="signup.php">disini</a>.</p>
      </div>
      </div>

      </div>

    </div>
    </section>

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