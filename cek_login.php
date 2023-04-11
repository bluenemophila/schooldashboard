<?php

require "config.php";

  $pass = md5($_POST['password']);
  $username = mysqli_escape_string($conn, $_POST['username']);
  $password = mysqli_escape_string($conn, $pass);
  $level = mysqli_escape_string($conn, $_POST['level']);

  // var_dump($_POST['remember']);
  // die;
          

  //var_dump($username, $password, $level);
  //exit;

  $cek_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' and level = '$level'");

  //if (false === $cek_user) {
  	//echo (mysqli_error($conn));
  //}
      	//var_dump($cek_user);
  		//exit;

  $user_valid = mysqli_fetch_array($cek_user);
    	//var_dump($user_valid['password'], $pass);
  		//exit;

  if ($user_valid) {
  	if($pass == $user_valid['password']) {

  		session_start();
  		$_SESSION['username'] = $user_valid['username'];
  		$_SESSION['nama'] = $user_valid['name'];
  		$_SESSION['level'] = $user_valid['level'];


  		if($level == "admin") {

        if(isset($_POST['remember'])) {
        setcookie('id', $user_valid['id'], time() + 3600);
        setcookie('username', md5($username), time() + 3600);
      }

  			header('location: admin/home.php');
  		}

  		elseif($level == "dosen") {

        if(isset($_POST['remember'])) {
        setcookie('id', $user_valid['id'], time() + 3600);
        setcookie('username', md5($username), time() + 3600);}

  			header('location: dosen/home.php');
  		}

  		elseif($level == "mahasiswa") {

        if(isset($_POST['remember'])) {
        setcookie('id', $user_valid['id'], time() + 3600);
        setcookie('username', md5($username), time() + 3600);}

  			header('location: mahasiswa/home.php');
  		}
  	} else {
  	echo "<script>alert('Maaf, login gagal. Password anda tidak terdaftar!');
  		document.location='index.php'</script>";
  	}
  } else {
  	echo "<script>alert('Maaf, login gagal. Username anda tidak terdaftar!');
  		document.location='index.php'</script>";
  }
?>