<?php
session_start();

  if(!isset ($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
  }

include "../config.php";

$nama = $_SESSION['nama'];

  $query = mysqli_query($conn, "SELECT * FROM dosen WHERE nama_dosen = '$nama'");
  $row = mysqli_fetch_assoc($query);

  $image = $row['gambar'];

if(isset($_POST["submit"])) {

  // var_dump($_FILES['sheet']['name']);
  // die;

    $sheet = basename($_FILES['sheet']['name']);
    $objReader = new PHPExcel_Reader_Excel5($sheet);
    $data = $objReader -> load($_FILES['sheet']['tmp_name']);
    $objData = $data -> getActiveSheet();
    $dataArray = $objData -> toArray();

    for ($i=1; $i < count($dataArray); $i++) {
      $objData = $data -> getActiveSheet();
      foreach ($objData -> getDrawingCollection() as $gambar) {
        $string = $gambar -> getCoordinates();
        $coord = PHPExcel_Cell::coordinateFromString($string);
        $image = $gambar -> getImageResource();
        $gambar = $gambar -> getIndexedFilename();
        imagejpeg($image, '../images/'.$gambar);
      }
      $nim_mhs = $dataArray[$i]['1'];
      $kode_matkul = $dataArray[$i]['2'];
      $nip_dosen = $dataArray[$i]['3'];
      $nilai = $dataArray[$i]['4'];
    }

  $query = "INSERT INTO perkuliahan VALUES
            ('',$nim_mhs','$kode_matkul','$nip_dosen', '$nilai')";

  mysqli_query($conn, $query);


  //var_dump($_POST);
  //exit;

  if(mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Data Perkuliahan Berhasil Ditambahkan!');document.location.href = 'perkuliahan.php';</script>";
  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }
}

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
      <button onclick="myFunction()" class="dropbtn"><?= $row["nama_dosen"] ?><img src="../images/<?= $row['gambar'] ?>" width="40" height="40" class="rounded-circle"><i class="fas fa-sort-down icon"></i></button>
      <div id="myDropdown" class="dropdown-content">
        <a href="profil.php"><i class="fas fa-id-card icon"></i>Profil</a>
        <a href="mengajar.php"><i class="fas fa-envelope-open-text icon"></i>Mata Kuliah yang Diampu</a>
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

            <div class="dropdown5">
            <li class="active"><a class="dropbutton6"><i class="fas fa-university nav-fa-icon icon"></i>Database Perkuliahan  <i class="fas fa-sort-down"></i></a></li>
              <div class="dropdown-content5">
                <a href="perkuliahan.php"><i class="fas fa-university icon"></i>Database Perkuliahan</a>
                <a href="tambah_perkuliahan.php"><i class="fas fa-plus-square icon"></i>Tambah Data Perkuliahan</a>
                <a href="import_perkuliahan.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
              </div>
            </div>

          </ul>
        </nav>
       </div>
      </div>

    </section>

      <section id="breadcrumb">
        <div class="container">
          <div class="baris3 d-flex">
          <p class="breadcrumb-text"><a href="home.php">Home</a> &rsaquo; <a href="perkuliahan.php">Database Perkuliahan</a> &rsaquo; Import Data Perkuliahan</p>
          </div>
        </div>
      </section>

<section id="content">
<div class="content wrap">

      <div class="container">
      <div class="row justify-content-start">
        <div class="col-6">
        <a href="perkuliahan.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left icon"></i>  Kembali</a>
        </div>
      </div>
    </div>

    <!-- tambah data -->
<div class="container text-left mb-4 form">
      <h1 class="text-center text-gradient"> <i class="fa fa-university"> </i></h1>
      <h4 class="text-left"> Import Data Perkuliahan </h4> <hr> <br>

      <form action="" method="post" enctype="multipart/form-data">
        <h6>Masukkan Datasheet :</h6>
          <div class="mb-3">
            <label for="sheet" class="form-label sub-text">*Tipe file : .xls, .xlsx</label>
            <input class="form-control" type="file" id="sheet" name="sheet" required>
          </div>
        <br>
        
        <div class="d-flex justify-content-center">
        <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-file-import icon"></i>Import Datasheet</button>
        </div>

      </form>
    </div>

    <!-- akhir tambah data -->


</div>
</section>

<section id="corner-img" class="corner-img d-flex justify-content-end">
  <img src="../images/content12.png">
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
