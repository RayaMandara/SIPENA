<?php
include ("koneksi.php");
session_start();

$nis = $_POST['nis'];
$password = $_POST['password'];


$query = "SELECT * FROM siswa WHERE nis = '$nis' AND id_user = '$password'";
$sql   = mysqli_query($koneksi, $query);
$row   = mysqli_num_rows($sql);

if ($row > 0) {

    $r = mysqli_fetch_array($sql);
    $_SESSION['nama_siswa']   = $r['nama_siswa'];
    $_SESSION['id_kelas'] = $r['id_kelas'];
    header("Location: index.php");
}else {
    header("Location: login.php?pesan=gagal");
}



?>