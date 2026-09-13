<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Data Perizinan Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#">Beranda</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Perizinan Siswa</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-bs-toggle="modal"
            data-bs-target="#tambah_user">
            + Tambah Izin
        </button>
        <!--begin::Row-->
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Izin</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">File</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tgl. Dibuat</th>
                            <th scope="col">Aksi</th>
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
                                <td><?= $row['nama_siswa'] ?></td>
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
                                <td>
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit_izin<?= $row['id_izin'] ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="hapus<?= $row['id_izin'] ?>">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                                <script>
                                    document.getElementById("hapus<?= $row['id_izin'] ?>").addEventListener("click", function(event) {
                                        event.preventDefault();
                                        Swal.fire({
                                            title: "Are you sure?",
                                            text: "You won't be able to revert this!",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            confirmButtonText: "Yes, delete it!"
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'action/action_izin.php?aksi=hapus&id_izin=<?= $row['id_izin'] ?>';
                                            };
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit_izin<?= $row['id_izin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Izin</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="action/action_izin.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="aksi" value="edit">
                                        <input type="hidden" name="id_izin" value="<?= $row['id_izin'] ?>">
                                        
                                        <div class="mb-3">
                                            <label for="edit_siswa<?= $row['id_izin'] ?>" class="form-label">Nama Siswa</label>
                                            <select name="id_siswa" id="edit_siswa<?= $row['id_izin'] ?>" class="form-select" required>
                                                <?php
                                                $query_s  = "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa ASC";
                                                $result_s = mysqli_query($koneksi, $query_s);
                                                while ($row_s = mysqli_fetch_array($result_s)) :
                                                    ?>
                                                    <option value="<?= $row_s['id_siswa'] ?>" <?= ($row_s['id_siswa'] == $row['id_siswa']) ? 'selected' : '' ?>>
                                                        <?= $row_s['nama_siswa'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_jenis<?= $row['id_izin'] ?>" class="form-label">Jenis Izin</label>
                                            <select name="id_jenis" id="edit_jenis<?= $row['id_izin'] ?>" class="form-select" required>
                                                <?php
                                                $query_j  = "SELECT id_jenis, nama_jenis FROM jenis_izin ORDER BY nama_jenis ASC";
                                                $result_j = mysqli_query($koneksi, $query_j);
                                                while ($row_j = mysqli_fetch_array($result_j)) :
                                                    ?>
                                                    <option value="<?= $row_j['id_jenis'] ?>" <?= ($row_j['id_jenis'] == $row['id_jenis']) ? 'selected' : '' ?>>
                                                        <?= $row_j['nama_jenis'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" required value="<?= $row['tanggal'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Waktu Mulai</label>
                                            <input type="time" class="form-control" name="waktu_mulai" required value="<?= $row['waktu_mulai'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Waktu Selesai</label>
                                            <input type="time" class="form-control" name="waktu_selesai" required value="<?= $row['waktu_selesai'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alasan</label>
                                            <textarea class="form-control" rows="3" name="alasan" required><?= $row['alasan'] ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">File Surat</label>
                                            <input type="file" class="form-control" name="file_surat">
                                            <?php if (!empty($row['file_surat'])): ?>
                                                <small class="text-muted d-block mt-1">File saat ini: <strong><?= $row['file_surat'] ?></strong> (Kosongkan jika tidak ingin mengubah file)</small>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="menunggu" <?= ($row['status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                                <option value="disetujui" <?= ($row['status'] == 'disetujui') ? 'selected' : '' ?>>Disetujui</option>
                                                <option value="ditolak" <?= ($row['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->

        <!-- /.row (main row) -->
        </div>
        <!--end::Container-->
        </div>
        <!--end::App Content-->
        </main>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Izin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="action/action_izin.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="aksi" id="" value="tambah" hidden>
                            <div class="mb-3">
                                <label for="id_siswa" class="form-label">Nama Siswa</label>
                                <select id="id_siswa" name="id_siswa" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Nama Siswa --</option>
                                    <?php
                                    $query_siswa  = "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa ASC";
                                    $result_siswa = mysqli_query($koneksi, $query_siswa);
                                    while ($row_siswa = mysqli_fetch_array($result_siswa)):
                                        ?>
                                        <option value="<?= $row_siswa['id_siswa'] ?>"><?= $row_siswa['nama_siswa'] ?></option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>
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
                                <input type="date" class="form-control" id="tanggal" aria-describedby="emailHelp" name="tanggal"
                                required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-control" id="waktu_mulai" aria-describedby="emailHelp" name="waktu_mulai"
                                required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" id="waktu_selesai" aria-describedby="emailHelp" name="waktu_selesai"
                                required>
                            </div>
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <!-- <input type="number" class="form-control" id="no_hp" aria-describedby="emailHelp" name="no_hp" required> -->
                                <textarea class="form-control" name="alasan" id="alasan" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">File Surat</label>
                                <input type="file" class="form-control" id="file" aria-describedby="emailHelp" name="file_surat"
                                required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" name="status" required>
                                    <option selected disabled>-- Pilih Status --</option>
                                    <option value="menunggu">Menunggu</option>
                                    <option value="disetujui">Disetujui</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>