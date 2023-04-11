<?php

require "../config.php";

$nip = $_GET["nip"];

function hapus($nip) {
	global $conn;
	mysqli_query($conn, "DELETE FROM dosen WHERE nip = '$nip' ");
	return mysqli_affected_rows($conn);
}

if(hapus($nip) > 0) {
	echo "<script>alert('Data Dosen Berhasil Dihapus!');document.location.href = 'dosen.php';</script>";

  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }

?>