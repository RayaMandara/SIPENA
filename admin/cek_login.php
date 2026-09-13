<?php
include ("../koneksi.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];


$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$sql   = mysqli_query($koneksi, $query);
$row   = mysqli_num_rows($sql);

if ($row > 0) {

    $r = mysqli_fetch_array($sql);
    $_SESSION['username']   = $r['username'];
    $_SESSION['nama_lengkap'] = $r['nama_lengkap'];
    $_SESSION['role'] = $r['role'];
    header("Location: index.php");
}else {
    header("Location: login.php?pesan=gagal");
}



?>