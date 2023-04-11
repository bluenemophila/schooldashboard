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

$jumlahdataperhalaman = 15;
$jumlahdata = count(query("SELECT * FROM matakuliah"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$awaldata = ($jumlahdataperhalaman * $halaman) - $jumlahdataperhalaman;

  $matkul = query("SELECT * FROM matakuliah LIMIT $awaldata, $jumlahdataperhalaman");

if( isset($_POST['cari'])) {
  $field = $_POST["field"];
  $keyword = $_POST["keyword"];
} else $keyword = NULL;

    if ($keyword) {
  $matkul = cari_matkul($field, $keyword);
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
          <p class="breadcrumb-text"><a href="home.php">Home</a> &rsaquo; Database Mata Kuliah</p>
          </div>
        </div>
      </section>

<section id="content">

  <div class="content wrap">


    <!-- title -->
  <div class="d-flex justify-content-start">
  <div>
  <h3><i class="fa fa-book-reader"> </i> Tabel Data Mata Kuliah <hr></h3><br>
  </div>
  </div>
<!-- endtitle -->

        <!-- search -->
      <div class="d-flex justify-content-end">
      <div class="srch">
        <form class="d-flex justify-content-end md-form form-sm active-cyan active-cyan-2 mt-2" action="matkul_cari.php" method="post">

          <select class="form-select form-select-cari" id="field" name="field">
            <option selected>Cari Berdasarkan</option>
            <option value="kode_mk">Kode Mata Kuliah</option>
            <option value="nama_mk">Nama Mata Kuliah</option>
          </select>

          <input class="form-control form-control-cari" type="text" placeholder="Masukkan Keyword Pencarian.." name="keyword" autocomplete="off">

          <button type="submit" name="cari" class="btn btn-info"><i class="fa fa-search icon"></i>Cari</button>
        </form>
      </div>
    </div>
            <!-- akhir search -->

  <h5>Total <?= $jumlahdata ?> Mata Kuliah</h5>


    <section class="table" id="table">
      <div class="table-container">
      <div class="table-responsive-sm">
        <table class="table table-striped table-bordered table-hover">
          <thead class="text-center table-dark align-middle">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Mata Kuliah</th>
              <th scope="col">Nama Mata Kuliah</th>
              <th scope="col">SKS</th>
            </tr>
          </thead>

        <?php $i = $awaldata + 1; ?>
          <?php foreach($matkul as $baris) : ?>
            <tr class="text-center align-middle">
              <td><?= $i; ?></td>
              <td><?= $baris["kode_mk"] ?></td>
              <td><?= $baris["nama_mk"] ?></td>
              <td><?= $baris["sks"] ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </table>
      </div>
      </div>
    </section>

<section id="pagination">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center align-middle">
        <li class="page-item">
          <?php if($halaman >1) : ?>
          <a class="page-link" href="?halaman=<?= $halaman - 1;?>" tabindex="-1" aria-disabled="true">&laquo;  Previous</a>
        <?php endif; ?>
        </li>
        <?php for($j=1; $j <= $jumlahhalaman; $j++ ):?>
        <li class="page-item"><a class="page-link" href="?halaman=<?= $j;?>"><?= $j;?></a></li>
      <?php endfor; ?>
        <li class="page-item">
          <?php if($halaman < $jumlahhalaman) : ?>
          <a class="page-link" href="?halaman=<?= $halaman + 1;?>">Next  &raquo;</a>
          <?php endif; ?>
        </li>
      </ul>
    </nav>
</section>

</div>
</section>

<section id="corner-img" class="corner-img d-flex justify-content-end">
  <img src="../images/content3.png">
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


<script type="text/javascript">
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
</script>



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