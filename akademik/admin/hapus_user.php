<?php

require "../config.php";

$username = $_GET["username"];

function hapus($username) {
	global $conn;
	mysqli_query($conn, "DELETE FROM users WHERE username = '$username' ");
	return mysqli_affected_rows($conn);
}

if(hapus($username) > 0) {
	echo "<script>alert('User Berhasil Dihapus!');document.location.href = 'users.php';</script>";

  } else {
    echo "Gagal"; echo "<br>"; echo mysqli_error($conn);
  }

?>