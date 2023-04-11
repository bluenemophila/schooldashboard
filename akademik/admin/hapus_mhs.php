<?php

require "../config.php";

$nim1 = $_GET["nim"];

function hapus($nim1) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = '$nim1' ");
	return mysqli_affected_rows($conn);
}

if(hapus($nim1) > 0) {
	echo "<script>alert('Data Mahasiswa Berhasil Dihapus!');document.location.href = 'mahasiswa.php';</script>";

  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }

?>