<?php
include("../../koneksi.php");

if (isset($_POST['aksi'])) {
    $aksi = $_POST['aksi'];

    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($aksi == 'tambah') {
        $id_siswa = $_POST['id_siswa'];
        $id_jenis = $_POST['id_jenis'];
        $tanggal = $_POST['tanggal'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $alasan = $_POST['alasan'];
        $status = $_POST['status'];
        $tgl_dibuat = date('Y-m-d H:i:s');

        $file_surat = '';
        $upload_file = isset($_FILES['file_surat']) ? $_FILES['file_surat'] : (isset($_FILES['file']) ? $_FILES['file'] : null);

        if ($upload_file && $upload_file['error'] == 0) {
            $file_name = time() . '_' . basename($upload_file['name']);
            $file_tmp = $upload_file['tmp_name'];
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $file_surat = $file_name;
        }

        $query = "INSERT INTO izin (id_siswa,id_jenis,tanggal,waktu_mulai,waktu_selesai,alasan,file_surat,status,tgl_dibuat) 
                  VALUES ('$id_siswa','$id_jenis','$tanggal','$waktu_mulai','$waktu_selesai','$alasan','$file_surat','$status','$tgl_dibuat')";

        mysqli_query($koneksi, $query);

        header("Location: ../index.php?menu=data_izin&pesan=berhasil");
        exit;
    } elseif ($aksi == 'edit') {
        $id = isset($_POST['id_izin']) ? $_POST['id_izin'] : (isset($_POST['id']) ? $_POST['id'] : null);
        $id_siswa = $_POST['id_siswa'];
        $id_jenis = $_POST['id_jenis'];
        $tanggal = $_POST['tanggal'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $alasan = $_POST['alasan'];
        $status = $_POST['status'];

        $file_surat = '';
        $upload_file = isset($_FILES['file_surat']) ? $_FILES['file_surat'] : (isset($_FILES['file']) ? $_FILES['file'] : null);

        if ($upload_file && $upload_file['error'] == 0) {
            // Hapus file lama jika ada
            $query_old = "SELECT file_surat FROM izin WHERE id_izin = '$id'";
            $res_old = mysqli_query($koneksi, $query_old);
            if ($row_old = mysqli_fetch_assoc($res_old)) {
                if (!empty($row_old['file_surat']) && file_exists($upload_dir . $row_old['file_surat'])) {
                    unlink($upload_dir . $row_old['file_surat']);
                }
            }

            $file_name = time() . '_' . basename($upload_file['name']);
            $file_tmp = $upload_file['tmp_name'];
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $file_surat = $file_name;
        }

        if ($file_surat) {
            $query = "UPDATE izin SET
               id_siswa = '$id_siswa',
               id_jenis = '$id_jenis',
               tanggal = '$tanggal',
               waktu_mulai = '$waktu_mulai',
               waktu_selesai = '$waktu_selesai',
               alasan = '$alasan',
               file_surat = '$file_surat',
               status = '$status'
               WHERE id_izin = '$id'";
        } else {
            $query = "UPDATE izin SET
               id_siswa = '$id_siswa',
               id_jenis = '$id_jenis',
               tanggal = '$tanggal',
               waktu_mulai = '$waktu_mulai',
               waktu_selesai = '$waktu_selesai',
               alasan = '$alasan',
               status = '$status'
               WHERE id_izin = '$id'";
        }

        mysqli_query($koneksi, $query);

        header("Location: ../index.php?menu=data_izin&pesan=edit");
        exit;
    }
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = isset($_GET['id_izin']) ? $_GET['id_izin'] : null;

    if ($id) {
        $query_file = "SELECT file_surat FROM izin WHERE id_izin = '$id'";
        $result_file = mysqli_query($koneksi, $query_file);
        $row_file = mysqli_fetch_array($result_file);
        if ($row_file && !empty($row_file['file_surat']) && file_exists("../uploads/" . $row_file['file_surat'])) {
            unlink("../uploads/" . $row_file['file_surat']);
        }

        $query = "DELETE FROM izin WHERE id_izin = '$id'";
        mysqli_query($koneksi, $query);
    }
    header("Location: ../index.php?menu=data_izin&pesan=hapus");
    exit;
}