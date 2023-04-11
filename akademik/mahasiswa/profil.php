<?php
session_start();

  if(!isset ($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
  }

include "../config.php";

$nama = $_SESSION['nama'];


  $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nama_mhs = '$nama'");
  $row = mysqli_fetch_assoc($query);

  $image = $row['image'];

  function tgl($tanggal) {
  $bulan = array (
  1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  $pecahkan = explode('-', $tanggal);

  return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
}

  $tgl_lahir = tgl($row['tgl_lahir']);

  // var_dump($row);
  // die;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" sizes="16x16" href="../images/star.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Database Akademik NPS University</title>
  </head>
  <body class="overall">

    <section id="navbar">

      <div class="navbar">
      <div class="container">
        <div class="logo">
          <img src="../images/logo1.png" width="250px">
        </div>

    <nav>
      <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn"><?= $row["nama_mhs"] ?><img src="../images/<?= $row['image'] ?>" width="40" height="40" class="rounded-circle"><i class="fas fa-sort-down icon"></i></button>
      <div id="myDropdown" class="dropdown-content">
        <a href="profil.php"><i class="fas fa-id-card icon"></i>Profil</a>
        <a href="nilai.php"><i class="fas fa-envelope-open-text icon"></i>Mata Kuliah Semester Ini</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
      </div>
      </div>
      </nav>
      </div>
      </div>

      <div class="stickynav" id="stickynav">
      <div class="container">
        <nav>
          <ul>
            <li><a href="home.php"><i class="fas fa-home nav-fa-icon icon"></i>Home</a></li>
            <li><a href="mahasiswa.php"><i class="fas fa-user-graduate nav-fa-icon icon"></i>Database Mahasiswa</a></li>
            <li><a href="dosen.php"><i class="fas fa-chalkboard-teacher nav-fa-icon icon"></i>Database Dosen</a></li>
            <li><a href="matkul.php"><i class="fas fa-book-reader nav-fa-icon icon"></i>Database Mata Kuliah</a></li>
            <li><a href="perkuliahan.php"><i class="fas fa-university nav-fa-icon icon"></i>Database Perkuliahan</a></li>
          </ul>
        </nav>
       </div>
      </div>

    </section>

      <section id="breadcrumb">
        <div class="container">
          <div class="baris3 d-flex">
          <p class="breadcrumb-text"><a href="home.php">Home</a> &rsaquo; Profil Mahasiswa</p>
          </div>
        </div>
      </section>

<section id="content">

  <div class="content wrap">


    <!-- title -->
  <div class="d-flex justify-content-center">
  <div>
  <h3><i class="fa fa-user-graduate"> </i> Profil Mahasiswa <hr></h3><br>
  </div>
  </div>
<!-- endtitle -->

          <div class="col-sm-12 align-items-center d-flex justify-content-center profil">
          <img src="../images/<?= $row['image'] ?>" width="200px" height="200px" class="rounded-circle">
          </div>


        <table class="table table-striped table-bordered">
          <tr>
          <td>
          <h5>NIM</h5>
          </td>
          <td>
          <h5><?= $row["nim"] ?></h5>
          </td>
          </tr>
          <tr>
          <td>
          <h5>Nama</h5>
          </td>
          <td>
          <h5><?= $row["nama_mhs"] ?></h5>
          </td>
          </tr>
          <tr>
          <td>
          <h5>Tanggal Lahir</h5>
          </td>
          <td>
          <h5><?= $tgl_lahir ?></h5>
          </td>
          </tr>
          <tr>
          <td>
          <h5>Alamat</h5>
          </td>
          <td>
          <h5><?= $row["alamat"] ?></h5>
          </td>
          </tr>
          <tr>
          <td>
          <h5>Jenis Kelamin</h5>
          </td>
          <td>
          <h5><?= $row["jenis_kelamin"] ?></h5>
          </td>
          </tr>
        </table>

</div>
</section>

<section id="corner-img" class="corner-img d-flex justify-content-end">
  <img src="../images/content1.png">
</section>

    <section id="footer">
      <div class="footer">
        <div class="container">
          <div class="baris2">
        <div class="footer-logo">
          <img src="../images/logo1.png" width="150px">
        </div>
        <p class="footer-p"> &copy; Copyright 2020 | NPS University | Sistem Informasi Manajemen B</p>
          </div>
        </div>
      </div>
    </section>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

  <script type="text/javascript">
  function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }

  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  </script>


<!-- <script type="text/javascript">
window.onscroll = function() {myFunction1()};


var stickynav = document.getElementById("stickynav");

var sticky = stickynav.offsetTop;


function myFunction1() {
  if (window.pageYOffset >= sticky) {
    stickynav.classList.add("sticky")
  } else {
    stickynav.classList.remove("sticky");
  }
}
</script> -->



<script type="text/javascript">
$(document).ready(function(){
                var url = window.location;
                $('ul li a').filter(function() {
                     return this.href == url;
                }).parent().addClass('active');
            });
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