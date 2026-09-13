<?php

  include('../../koneksi.php');
  if ($aksi = $_POST['aksi']) {
    if ($aksi == 'tambah') {
      $nama_kelas = $_POST['nama_kelas'];
      $jurusan = $_POST['jurusan'];
      $tingkat = $_POST['tingkat'];
      $wali_kelas = $_POST['wali_kelas'];

      $query = "INSERT INTO kelas (nama_kelas, jurusan, tingkat, wali_kelas) 
              VALUES('$nama_kelas','$jurusan','$tingkat','$wali_kelas')";

      mysqli_query($koneksi, $query);

      header("Location: ../index.php?menu=data_kelas&pesan=berhasil");
    } elseif ($aksi == 'edit') {
      $id = $_POST['id'];
      $nama_kelas = $_POST['nama_kelas'];
      $jurusan = $_POST['jurusan'];
      $tingkat = $_POST['tingkat'];
      $wali_kelas = $_POST['wali_kelas'];

      $query = "UPDATE kelas SET
      nama_kelas = '$nama_kelas',
      jurusan = '$jurusan',
      tingkat = '$tingkat',
      wali_kelas = '$wali_kelas'
      WHERE id_kelas = '$id'";

      mysqli_query($koneksi, $query);

      header("Location: ../index.php?menu=data_kelas&pesan=edit");
    }
  }

  if ($aksi = $_GET['aksi']) {
    $id = $_GET['id_kelas'];
    $query = "DELETE FROM kelas WHERE id_kelas = '$id'";
    mysqli_query($koneksi, $query);
    header("Location: ../index.php?menu=data_kelas&pesan=hapus");
  }