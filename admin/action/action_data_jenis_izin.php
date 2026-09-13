<?php

include("../../koneksi.php");

if ($aksi = $_POST['aksi']) {
    if ($aksi == 'tambah') {    
        $nama_jenis     = $_POST['nama_jenis'];
        $deskripsi     = $_POST['deskripsi'];

        $query = "INSERT INTO jenis_izin VALUES(NULL,'$nama_jenis','$deskripsi')";
        // echo $query;
        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_jenis_izin&pesan=berhasil");

    } elseif ($aksi == 'edit') {
        $id_jenis     = $_POST['id_jenis'];
        $nama_jenis     = $_POST['nama_jenis'];
        $deskripsi     = $_POST['deskripsi'];

        $query = "UPDATE jenis_izin SET
            nama_jenis='$nama_jenis',
            deskripsi='$deskripsi'
            WHERE id_jenis='$id_jenis'";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_jenis_izin&pesan=edit");
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_jenis = $_GET['id_jenis'];
    $query = "DELETE FROM jenis_izin WHERE id_jenis = '$id_jenis'";
    mysqli_query($koneksi, $query);
    header("location: ../index.php?menu=data_jenis_izin&pesan=hapus");
}

?>