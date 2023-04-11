<?php

require "../config.php";

$id = $_GET["id"];

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM perkuliahan WHERE id = '$id' ");
	return mysqli_affected_rows($conn);
}

if(hapus($id) > 0) {
	echo "<script>alert('Data Perkuliahan Berhasil Dihapus!');document.location.href = 'perkuliahan.php';</script>";

  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }

?>