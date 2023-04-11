<?php

$conn = mysqli_connect("localhost","root", "", "akademik") or die (mysqli_error($conn));

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function signup($data) {
	global $conn;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$name = stripslashes($data["name"]);
	$level = mysqli_escape_string($conn, $data["level"]);

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

	mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password','$name','$level')");

	return mysqli_affected_rows($conn);
}

//function tambah_mhs($data) {
	//global $conn;

	// $nim = htmlspecialchars($_POST['nim']);
 //  	$nama = htmlspecialchars($_POST['nama']);
 //  	$tgl_lahir = $_POST['tgl_lahir'];
 //  	$alamat = htmlspecialchars($_POST['alamat']);
 //  	$jenis_kelamin = $_POST['jenis_kelamin'];

	//   $gambar = upload();
	//   if (!$gambar) {
	//     return false;
	//   }

	//   //var_dump($gambar);
	//   //exit;

 //  $query = "INSERT INTO mahasiswa VALUES
 //            ('$nim','$nama','$tgl_lahir','$alamat','$jenis_kelamin','$gambar')";

 //  mysqli_query($conn, $query);

 //  return mysqli_affected_rows($conn);
//}

function upload() {

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

	move_uploaded_file($tmpName, '../images/'. $namaFileBaru);

	return $namaFileBaru;

}

function cari_mhs($field, $keyword) {
		$query = "SELECT * FROM mahasiswa WHERE
		$field LIKE '%$keyword%'";
		return query($query);
	}

function cari_perkuliahan($field, $keyword) {
	global $conn;
		$query = "SELECT * FROM perkuliahan LEFT JOIN mahasiswa ON perkuliahan.nim_mhs = mahasiswa.nim LEFT JOIN matakuliah ON perkuliahan.kode_matkul = matakuliah.kode_mk LEFT JOIN dosen ON perkuliahan.nip_dosen = dosen.nip WHERE
		$field LIKE '%$keyword%'";

		return query($query);
	}

function cari_matkul($field, $keyword) {
		$query = "SELECT * FROM matakuliah WHERE
		$field LIKE '%$keyword%'";
		return query($query);
	}

function cari_dosen($field, $keyword) {
		$query = "SELECT * FROM dosen WHERE
		$field LIKE '%$keyword%'";
		return query($query);
	}

function cari_user($field, $keyword) {
		$query = "SELECT * FROM users WHERE
		$field LIKE '%$keyword%'";
		return query($query);
	}

  function tanggal($tanggal) {
  $bulan = array (
  1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  $pecahkan = explode('-', $tanggal);

  return $pecahkan[2].' '.$bulan[(int)$pecahkan[1]].' '.$pecahkan[0];
}

?>