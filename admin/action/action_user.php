<?php

include("../../koneksi.php");

if ($aksi = $_POST['aksi']) {
    if ($aksi == 'tambah') {
        $username     = $_POST['username'];
        $password     = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email        = $_POST['email'];
        $no_hp        = $_POST['no_hp'];
        $role         = $_POST['role'];

        $query = "INSERT INTO users VALUES(NULL,'$username','$password','$nama_lengkap','$email','$no_hp','$role')";
        // echo $query;
        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_user&pesan=berhasil");

    } elseif ($aksi == 'edit') {
        $id_user      = $_POST['id_user'];
        $username     = $_POST['username'];
        $password     = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email        = $_POST['email'];
        $no_hp        = $_POST['no_hp'];
        $role         = $_POST['role'];

        $query = "UPDATE users SET
            username='$username',
            password='$password',
            nama_lengkap='$nama_lengkap',
            email='$email',
            no_hp='$no_hp',
            role='$role'
            WHERE id_user='$id_user'";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_user&pesan=edit");
    }
}


if ($aksi = $_GET['aksi']) {
    $id = $_GET['id_user'];
    $query = "DELETE FROM users WHERE id_user = '$id'";
    mysqli_query($koneksi, $query);
    header("location: ../index.php?menu=data_user&pesan=hapus");
}