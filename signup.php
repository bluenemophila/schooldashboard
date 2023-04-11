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

// if (isset($_POST['signup'])) {


//   // var_dump($username, $password, $name, $level);
//   // die;
// }

function upload_gambar() {

  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  if($error === 4) {
    echo "<script>alert('Pilih gambar terlebih dahulu!'); </script>";
    return false;
  }

  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>alert('Yang anda upload bukan gambar!'); </script>";
  }

  if($ukuranFile > 2000000) {
    echo "<script>alert('Ukuran gambar terlalu besar!'); </script>";
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'images/'. $namaFile);

  return $namaFile;

}

if(isset($_POST["submit"])) {

    $nim = htmlspecialchars($_POST['nim']);
    $nama = htmlspecialchars($_POST['nama']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $jenis_kelamin = $_POST['jenis_kelamin'];

    $gambar = upload_gambar();
    if (!$gambar) {
      return false;
    }

  $username = strtolower(stripslashes($_POST["username"]));
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
  $level = strtolower(mysqli_escape_string($conn, $_POST["level"]));

  $hasil = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
  if(mysqli_fetch_assoc($hasil)) {
    echo "<script>
    alert('Username Sudah Terdaftar!')</script>";
    return false;
  }

  if($password !== $password2) {
    echo "<script>
        alert('Konfirmasi Password Tidak Sesuai') </script>";
    return false;
  }

  $password = md5($password);


  $query = "INSERT INTO mahasiswa VALUES
            ('$nim','$nama','$tgl_lahir','$alamat','$jenis_kelamin','$gambar','$username','$password','$level');
            INSERT INTO users VALUES
            ('','$username','$password','$nama','$level')";

  mysqli_multi_query($conn, $query);

  // var_dump($nama, $username, $password);
  // exit;

  if(mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('User berhasil didaftarkan!');document.location.href = 'login.php';</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" sizes="16x16" href="images/star.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Database Akademik NPS University</title>
  </head>
  <body class="login-page">

    <section id="signup">
      <div class="container text-left p-5">

      <div class="row">

      <div class="col-6 d-flex">
        <img src="images/content5.png">
      </div>

      <div class="col-6 d-flex align-middle">
        <div class="signup-text">
        <i class="fa fa-star star-1 gradient-text"></i>
        <h1>Sign Up</h1>
        <i class="fa fa-star star-2 gradient-text"></i>
        <h5 class="d-flex justify-content-center"><i class="fa fa-quote-left"></i>Instruction does much,<br>but encouragement everything.<i class="fa fa-quote-right"></i></h5>
        <h6 class="d-flex justify-content-end">&#8212; Johann Wolfgang von Goethe</h6>
        </div>
      </div>

      </div>



      <div class="wrap1 p-5">
        <a href="index.php" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left mr-5"></i>  Kembali</a>
      <h1 class="text-center gradient-text mt-5"> <i class="fa fa-graduation-cap"> </i></h1>
      <h4 class="text-left"> Biodata Mahasiswa </h4> <hr> <br>

      <form action="" method="post" enctype="multipart/form-data">
        <h6>1. Masukkan NIM Anda :</h6>
          <div class="form-floating mb-3">
          <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM Anda" required>
          <label for="nim">NIM</label>
          </div>
        <br>
        <h6>2. Masukkan Nama Anda :</h6>
        <div class="form-floating mb-3">
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
            <label for="nama">Nama Mahasiswa</label>
        </div>
        <br>
        <h6>3. Masukkan Tanggal Lahir Anda :</h6>
        <div class="form-floating mb-3">
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir Anda" required>
          <label for="alamat">Tanggal Lahir</label>
        </div>
        <br>
        <h6>4. Masukkan Alamat Anda :</h6>
        <div class="form-floating mb-3">
          <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Anda" required>
          <label for="alamat">Alamat</label>
        </div>
        <br>
        <h6>5. Pilih Jenis Kelamin Anda :</h6>
          <div class="form-floating mb-3">
          <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" required>
            <option selected>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          <label for="jenis_kelamin">Jenis Kelamin</label>
        </div>
        <br>
        <h6>6. Masukkan Gambar :</h6>
          <div class="mb-3">
            <label for="gambar" class="form-label">*Ukuran file tidak boleh lebih dari 2 MB</label>
            <input class="form-control" type="file" id="gambar" name="gambar">
          </div>
        <br>
        <br>
        <hr>
        <br>
        <br>

    <div class="text-left mb-4">
      <h1 class="text-center gradient-text"> <i class="fa fa-university"> </i></h1>
      <h4 class="text-left"> Daftar User <hr></h4>

          <div class="form-floating mb-3">
          <input type="text" name="level" id="level" readonly class="form-control" value="Mahasiswa" required>
          <label for="level">Level</label>
        </div>
        <br>
        <div class="form-floating mb-3">
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username Anda" required>
            <label for="username">Username</label>
        </div>
        <br>
        <div class="form-floating mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda" required>
          <label for="password">Password</label>
        </div>
        <br>
        <div class="form-floating mb-3">
          <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password Anda" required>
          <label for="password">Konfirmasi Password</label>
        </div>
        <br>
    </div>
        <div class="d-flex justify-content-center">
        <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-user-plus mr-2"></i>  Daftar</button>
        </div>

      </form>

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