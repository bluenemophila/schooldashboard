<?php

require "../config.php";

$kode_mk = $_GET["kode_mk"];

function hapus($kode_mk) {
	global $conn;
	mysqli_query($conn, "DELETE FROM matakuliah WHERE kode_mk = '$kode_mk' ");
	return mysqli_affected_rows($conn);
}

if(hapus($kode_mk) > 0) {
	echo "<script>alert('Data Mata Kuliah Berhasil Dihapus!');document.location.href = 'matkul.php';</script>";

  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }

?>