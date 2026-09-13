<?php

include('../../koneksi.php');
if ($aksi = $_POST['aksi']) {
  if ($aksi == 'tambah') {
    $id_user = $_POST['id_user'];
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $id_kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO siswa (id_user,nis, nama_siswa, id_kelas, tgl_lahir, jenis_kelamin, alamat, no_hp) VALUES('$id_user','$nis','$nama_siswa','$id_kelas','$tgl_lahir','$jenis_kelamin','$alamat','$no_hp')";

    mysqli_query($koneksi, $query);

    header("Location: ../index.php?menu=data_siswa&pesan=berhasil");
  } elseif ($aksi == 'edit') {
    $id = $_POST['id'];
    $id_user = $_POST['id_user'];
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $id_kelas = $_POST['kelas'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $query = "UPDATE siswa SET
      id_user = '$id_user',
      nis = '$nis',
      nama_siswa = '$nama_siswa',
      id_kelas = '$id_kelas',
      tgl_lahir = '$tgl_lahir',
      jenis_kelamin = '$jenis_kelamin',
      alamat = '$alamat',
      no_hp = '$no_hp'
      WHERE id_siswa = '$id'";

    mysqli_query($koneksi, $query);

    header("Location: ../index.php?menu=data_siswa&pesan=edit");
  }
}

if($aksi = $_GET['aksi']) {
  $id = $_GET['id_siswa'];
  $query = "DELETE FROM siswa WHERE id_siswa = '$id'";
  mysqli_query($koneksi, $query);
  header("Location: ../index.php?menu=data_siswa&pesan=hapus");
}