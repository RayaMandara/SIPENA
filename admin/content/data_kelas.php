<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Kelas</h1>

        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
      <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-bs-toggle="modal"
      data-bs-target="#tambahKelasModal">
      + Tambah Kelas
    </button>
    <!--begin::Row-->
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped table-hover" id="example">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama Kelas</th>
              <th scope="col">Jurusan</th>
              <th scope="col">Tingkat</th>
              <th scope="col">Wali Kelas</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query_user = "SELECT * FROM kelas";
            $results    = mysqli_query($koneksi, $query_user);
            while ($row = mysqli_fetch_array($results)):

              ?>
              <tr>
                <th scope="row"><?= $row['id_kelas'] ?></th>
                <td><?= $row['nama_kelas'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['tingkat'] ?></td>
                <td><?= $row['wali_kelas'] ?></td>

                <td>
                  <div class="aksi d-flex gap-1">
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editKelas<?= $row['id_kelas'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger" id="hapusKelas<?= $row['id_kelas'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      document.getElementById("hapusKelas<?= $row['id_kelas'] ?>").addEventListener("click", function(event) {
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
                            window.location.href = 'action/action_kelas.php?aksi=hapus&id_kelas=<?= $row['id_kelas'] ?>';
                          };
                        });
                      });
                    </script>
                  </div>
                </td>
              </tr>
              <!-- modal edit kelas -->
              <div class="modal fade" id="editKelas<?= $row['id_kelas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kelas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- form edit kelas -->
                      <form action="action/action_kelas.php" method="POST">
                        <div class="mb-3">
                          <!-- value edit -->
                          <input type="hidden" name="aksi" value="edit">
                          <input type="hidden" name="id" value="<?= $row['id_kelas'] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="nama_kelas_edit_<?= $row['id_kelas'] ?>" class="form-label">Nama Kelas</label>
                          <input type="text" class="form-control" id="nama_kelas_edit_<?= $row['id_kelas'] ?>" name="nama_kelas" value="<?= $row['nama_kelas'] ?>" placeholder="Masukkan Nama kelas">
                        </div>
                        <div class="mb-3">
                          <label for="jurusan_edit_<?= $row['id_kelas'] ?>" class="form-label">Jurusan</label>
                          <input type="text" class="form-control" id="jurusan_edit_<?= $row['id_kelas'] ?>" name="jurusan" value="<?= $row['jurusan'] ?>" placeholder="Masukkan Jurusan">
                        </div>
                        <div class="mb-3">
                          <label for="tingkat_edit_<?= $row['id_kelas'] ?>" class="form-label">Tingkat</label>
                          <input type="text" class="form-control" id="tingkat_edit_<?= $row['id_kelas'] ?>" name="tingkat" value="<?= $row['tingkat'] ?>" placeholder="Masukkan Tingkatan">
                        </div>
                        <div class="mb-3">
                          <label for="wali_kelas_edit_<?= $row['id_kelas'] ?>" class="form-label">Wali Kelas</label>
                          <select name="wali_kelas" class="form-select" id="wali_kelas_edit_<?= $row['id_kelas'] ?>" aria-label="Default select example">
                            <option value="" disabled>Pilih Wali Kelas</option>
                            <?php
                            $query_users  = "SELECT * FROM users WHERE role = 'Guru'";
                            $result_users = mysqli_query($koneksi, $query_users);
                            while ($row_users = mysqli_fetch_array($result_users)):
                              ?>
                              <option value="<?= $row_users['nama_lengkap'] ?>" <?= ($row_users['nama_lengkap'] == $row['wali_kelas']) ? 'selected' : '' ?>><?= $row_users['nama_lengkap'] ?></option>
                              <?php
                            endwhile;
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                      </div>
                    </form>
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

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form tambah user -->
        <form action="action/action_kelas.php" method="POST">
          <div class="mb-3">
            <!-- value tambah -->
            <input type="text" hidden name="aksi" value="tambah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama kelas">
          </div>
          <div class="mb-3">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan">
          </div>
          <div class="mb-3">
            <label for="tingkat" class="form-label">Tingkat</label>
            <input type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Masukkan Tingkatan">
          </div>
          <div class="mb-3">
            <label for="wali_kelas" class="form-label">Wali Kelas</label>
            <select name="wali_kelas" class="form-select" aria-label="Default select example">
              <option value="" selected disabled>Pilih Wali Kelas</option>
              <?php
              $query_users  = "SELECT * FROM users WHERE role = 'Guru'";
              $result_users = mysqli_query($koneksi, $query_users);
              while ($row_users = mysqli_fetch_array($result_users)):
                ?>
                <option value="<?= $row_users['nama_lengkap'] ?>"><?= $row_users['nama_lengkap'] ?></option>
                <?php
              endwhile;
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

