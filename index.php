<?php
session_start();
if (!isset($_SESSION['nama_siswa'])){
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIPENA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg border-bottom border-body bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">SIPENA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout_siswa.php">Logout</a>
                        </li>
                    </ul>
                    <h5 class="text-white mb-0">Sistem Perizinan Siswa</h5>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Header Start -->
        <div class="container mt-5 mb-4">
            <header class="alert alert-dark p-5" role="alert">
                <h1 class="fw-bold"><?= $_SESSION['nama_siswa'] ?></h1>
                <?php 
                $id = $_SESSION['id_kelas'];
                $query_kelas = "SELECT nama_kelas FROM kelas WHERE id_kelas = $id";
                $hasil = mysqli_query($koneksi, $query_kelas);
                $r = mysqli_fetch_array($hasil);
                ?>
                <h5><?= $r['nama_kelas'] ?></h5>
                <h4>SMK PARIWISATA TRIATMAJAYA BADUNG</h4>
            </header>
        </div>
        <!-- Header End -->

        <!-- Info Start -->
        <div class="container mb-4">
            <div class="row g-3">
                <div class="col-md-3 col-sm-6">
                    <div class="alert alert-info p-4 text-center mb-0 h-100">
                        <h1 class="fw-bold">2</h1>
                        <h6 class="mb-0">Ajuan</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="alert alert-warning p-4 text-center mb-0 h-100">
                        <h1 class="fw-bold">2</h1>
                        <h6 class="mb-0">Menunggu</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="alert alert-success p-4 text-center mb-0 h-100">
                        <h1 class="fw-bold">2</h1>
                        <h6 class="mb-0">Diterima</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="alert alert-danger p-4 text-center mb-0 h-100">
                        <h1 class="fw-bold">2</h1>
                        <h6 class="mb-0">Ditolak</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Info End -->

        <!-- Section Main Content -->
        <div class="container mb-5">
            <div class="row">
                <!-- Form Pengajuan Izin (Kolom Kiri) -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary text-white fw-bold">
                            + Pengajuan Izin
                        </div>
                        <div class="card-body">
                            <form action="action_izin_siswa.php" method="POST" enctype="multipart/form-data">
                                <input type="text" name="aksi" id="" value="tambah" hidden>

                                <div class="mb-3">
                                    <label for="id_jenis" class="form-label">Jenis Izin</label>
                                    <select id="id_jenis" name="id_jenis" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Jenis Izin --</option>
                                        <?php
                                        $query_jenis  = "SELECT id_jenis, nama_jenis FROM jenis_izin ORDER BY nama_jenis ASC";
                                        $result_jenis = mysqli_query($koneksi, $query_jenis);
                                        while ($row_jenis = mysqli_fetch_array($result_jenis)):
                                            ?>
                                            <option value="<?= $row_jenis['id_jenis'] ?>"><?= $row_jenis['nama_jenis'] ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Mulai Izin</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alasan" class="form-label">Alasan</label>
                                    <textarea class="form-control" name="alasan" id="alasan" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="file" class="form-label">File Surat</label>
                                    <input type="file" class="form-control" id="file" name="file_surat" required>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tabel Pengajuan (Kolom Kanan) -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-dark text-white fw-bold">
                            Tabel Pengajuan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Jenis Izin</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Alasan</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tgl. Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query_izin = "SELECT i.*, s.nama_siswa, ji.nama_jenis FROM izin i LEFT JOIN siswa s ON i.id_siswa = s.id_siswa LEFT JOIN jenis_izin ji ON i.id_jenis = ji.id_jenis";
                                        $results    = mysqli_query($koneksi, $query_izin);
                                        while ($row = mysqli_fetch_array($results)):

                                            ?>
                                            <tr>
                                                <th scope="row"><?= $row['id_izin'] ?></th>
                                                <td><?= $row['nama_jenis'] ?></td>
                                                <td><?= $row['tanggal'] ?></td>
                                                <td><?= $row['alasan'] ?></td>
                                                <td>
                                                    <?php if (!empty($row['file_surat'])): ?>
                                                        <a href="uploads/<?= $row['file_surat'] ?>" target="_blank" class="badge text-bg-info text-decoration-none">
                                                            <i class="bi bi-file-earmark"></i> <?= $row['file_surat'] ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $row['status'] ?></td>
                                                <td><?= $row['tgl_dibuat'] ?></td>
                                        </tr>
                                    <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>