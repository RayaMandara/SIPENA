<?php 

if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];

    switch ($menu) {
        case 'beranda':
            include('content/beranda.php');
            break;
        case 'data_user':
            include('content/data_user.php');
            break;
        case 'data_siswa':
            include('content/data_siswa.php');
            break;
        case 'data_kelas':
            include('content/data_kelas.php');
            break;
        case 'data_jenis_izin':
            include('content/data_jenis_izin.php');
            break;
        case 'data_izin':
            include('content/data_izin.php');
            break;
        case 'data_verifikasi':
            include('content/data_verifikasi.php');
            break;
        }
}else {
    include('content/beranda.php');
}

?>