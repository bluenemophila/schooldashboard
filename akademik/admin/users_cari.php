<?php
session_start();

  if(!isset ($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
  }

include "../config.php";

$nama = $_SESSION['nama'];

$jumlahdataperhalaman = 15;
$jumlahdata = count(query("SELECT * FROM users"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$awaldata = ($jumlahdataperhalaman * $halaman) - $jumlahdataperhalaman;

  $users = query("SELECT * FROM users LIMIT $awaldata, $jumlahdataperhalaman");


$hasil = NULL;

if( isset($_POST['cari'])) {
  $field = $_POST["field"];
  $keyword = $_POST["keyword"];

    if($field === "Cari Berdasarkan") {
      echo ("<script>alert('Field tidak boleh kosong!'); document.location.href = 'dosen.php';</script>");
      exit;
    }
} else $keyword = NULL;

    if ($keyword) {
  $users = cari_user($field, $keyword); }


if( isset($_POST['cari'])) {
  $kolom = $_POST["field"];
  $kunci = $_POST["keyword"];
  $_SESSION['field'] = $kolom;
  $_SESSION['keyword'] = $kunci;
  $keyword = $kunci;
  $field = $kolom;


  // var_dump($field,$keyword);
  // die;

} else {
  $keyword = $_SESSION['keyword'];
  $field = $_SESSION['field'];
  }


    if ($keyword) {
  $users = cari_user($field, $keyword);

  // var_dump($perkuliahan);
  // exit;

  $hasil = count($users);
    $_SESSION['hasil'] = $hasil;
  $hasil = $_SESSION['hasil'];

  // var_dump($hasil);
  // exit;

  $jumlahdataperhalaman = 15;
  $jumlahdata = $hasil;
  $jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
  $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
  $awaldata = ($jumlahdataperhalaman * $halaman) - $jumlahdataperhalaman;

    $users = query("SELECT * FROM users WHERE
    $field LIKE '%$keyword%' LIMIT $awaldata, $jumlahdataperhalaman");

}

  //var_dump($users);
  //die;

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
          <img src="../images/logo1.png" width="250">
        </div>

    <nav>
      <div class="dropdown">
      <button onclick="myFunction()" class="btn dropbtn"><?= $nama ?>  (Admin)  <i class="fas fa-sort-down icon"></i></button>
      <div id="myDropdown" class="dropdown-content">
        <a href="../logout.php"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
      </div>
      </div>
      </nav>
      </div>
      </div>

      <div class="stickynav" id="stickynav">
      <div class="stickynav-container">
        <nav>
          <ul>
            <li><a href="home.php"><i class="fas fa-home nav-fa-icon icon"></i>Home</a></li>

            <div class="dropdown2">
            <li><a class="dropbutton"><i class="fas fa-user-graduate nav-fa-icon icon"></i>Database Mahasiswa  <i class="fas fa-sort-down"></i></a></li>
              <div id="myDropdown2" class="dropdown-content2">
                <a href="mahasiswa.php"><i class="fas fa-user-graduate icon"></i>Database Mahasiswa</a>
                <a href="tambah_mhs.php"><i class="fas fa-plus-square icon"></i>Tambah Data Mahasiswa</a>
                <a href="import_mhs.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
              </div>
            </div>

            <div class="dropdown3">
            <li><a class="dropbutton1"><i class="fas fa-chalkboard-teacher nav-fa-icon icon"></i>Database Dosen  <i class="fas fa-sort-down"></i></a></li>
              <div id="myDropdown3" class="dropdown-content3">
                <a href="dosen.php"><i class="fas fa-chalkboard-teacher icon"></i>Database Dosen</a>
                <a href="tambah_dosen.php"><i class="fas fa-plus-square icon"></i>Tambah Data Dosen</a>
                <a href="import_dosen.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
              </div>
            </div>

            <div class="dropdown4">
            <li><a class="dropbutton2"><i class="fas fa-book-reader nav-fa-icon icon"></i>Database Mata Kuliah  <i class="fas fa-sort-down"></i></a></li>
              <div class="dropdown-content4">
                <a href="matkul.php"><i class="fas fa-book-reader icon"></i>Database Mata Kuliah</a>
                <a href="tambah_matkul.php"><i class="fas fa-plus-square icon"></i>Tambah Data Matkul</a>
                <a href="import_matkul.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
              </div>
            </div>

            <div class="dropdown5">
            <li><a class="dropbutton3"><i class="fas fa-university nav-fa-icon icon"></i>Database Perkuliahan  <i class="fas fa-sort-down"></i></a></li>
              <div class="dropdown-content5">
                <a href="perkuliahan.php"><i class="fas fa-university icon"></i>Database Perkuliahan</a>
                <a href="tambah_perkuliahan.php"><i class="fas fa-plus-square icon"></i>Tambah Data Perkuliahan</a>
                <a href="import_perkuliahan.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
              </div>
            </div>

            <div class="dropdown6">
            <li class="active"><a class="dropbutton4"><i class="fas fa-users nav-fa-icon icon"></i>Manajemen User  <i class="fas fa-sort-down"></i></a></li>
              <div class="dropdown-content6">
                <a href="users.php"><i class="fas fa-users icon"></i>Manajemen User</a>
                <a href="tambah_user.php"><i class="fas fa-plus-square icon"></i>Tambah Data User</a>
                <a href="import_user.php"><i class="fas fa-file-import icon"></i>Import Datasheet</a>
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
          <p class="breadcrumb-text"><a href="home.php">Home</a> &rsaquo; Manajemen User</p>
          </div>
        </div>
      </section>

<section id="content">

  <div class="content wrap">


    <!-- title -->
  <div class="d-flex justify-content-start">
        <div class="col-6">
        <a href="users.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left icon"></i>  Kembali</a>
        </div>
  </div>
<!-- endtitle -->

        <!-- search -->
      <div class="d-flex justify-content-end">
      <div class="srch">
        <form class="d-flex justify-content-end md-form form-sm active-cyan active-cyan-2 mt-2" action="users_cari.php" method="post">

          <select class="form-select form-select-cari" id="field" name="field">
            <option selected>Cari Berdasarkan</option>
            <option value="username">Username</option>
            <option value="name">Nama User</option>
          </select>

          <input class="form-control form-control-cari" type="text" placeholder="Masukkan Keyword Pencarian.." name="keyword" autocomplete="off">

          <button type="submit" name="cari" class="btn btn-info"><i class="fa fa-search icon"></i>Cari</button>
        </form>
      </div>
    </div>
            <!-- akhir search -->

    <?php if ($_SESSION['hasil']) : ?>
    <div class="container">
     <h4> Hasil pencarian : <?php echo "$hasil"; ?> </h4>
    </div>
    <?php endif; ?>



    <section class="table" id="table">
      <div class="table-container">
      <div class="table-responsive-sm">
        <table class="table table-striped table-bordered table-hover">
          <thead class="text-center table-dark align-middle">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Username</th>
              <th scope="col">Nama</th>
              <th scope="col">Level</th>
              <th colspan="2" scope="col">Aksi</th>
            </tr>
          </thead>

        <?php $i = $awaldata + 1; ?>
          <?php foreach($users as $baris) : ?>
            <tr class="text-center align-middle">
              <td><?= $i; ?></td>
              <td><?= $baris["username"] ?></td>
              <td><?= $baris["name"] ?></td>
              <td><?= $baris["level"] ?></td>
              <td class="text-center"><a href="edit_user.php?username=<?= $baris["username"] ?>"><button type="button" class="btn btn-success"><i class="fa fa-edit"></i> Edit</button></a></td>
              <td class="text-center"><a href="hapus_user.php?username=<?= $baris["username"] ?>" onclick="return confirm('Apakah anda yakin untuk menghapus?')";><button type="button" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Hapus</button></a></td>
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
  <img src="../images/content5.png">
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