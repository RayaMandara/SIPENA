<?php
// Set konfigurasi koneksi ke database
$host     = "localhost"; // Server database
$username = "root"; // Username MySQL
$password = ""; // Password MySQL, kosongkan jika tidak ada
$database = "sps2"; // Nama database yang ingin digunakan

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Jika berhasil, echo ini
// echo "Koneksi berhasil!";