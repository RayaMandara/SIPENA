<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Siswa</h1>

        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
      <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-bs-toggle="modal" data-bs-target="#tambahSiswaModal">
        + Tambah Siswa
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-striped table-hover" id="example">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">ID User</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query_siswa = "SELECT s.*, k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.id_kelas = k.id_kelas";
              $results     = mysqli_query($koneksi, $query_siswa);
              while ($row = mysqli_fetch_array($results)):

                ?>
                <tr>
                  <th scope="row"><?= $row['id_siswa'] ?></th>
                  <td><?= $row['id_user'] ?></td>
                  <td><?= $row['nis'] ?></td>
                  <td><?= $row['nama_siswa'] ?></td>
                  <td><?= $row['nama_kelas'] ?></td>
                  <td><?= $row['tgl_lahir'] ?></td>
                  <td><?= $row['jenis_kelamin'] ?></td>
                  <td><?= $row['alamat'] ?></td>
                  <td><?= $row['no_hp'] ?></td>

                  <td>
                    <div class="aksi d-flex gap-1">
                      <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSiswa<?= $row['id_siswa'] ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button type="button" class="btn btn-outline-danger" id="hapusSiswa<?= $row['id_siswa'] ?>">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                      <script>
                        document.getElementById("hapusSiswa<?= $row['id_siswa'] ?>").addEventListener("click", function(event) {
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
                              window.location.href = 'action/action_siswa.php?aksi=hapus&id_siswa=<?= $row['id_siswa'] ?>';
                            };
                          });
                        });
                      </script>
                    </div>
                  </td>
                </tr>
                <!-- modal edit siswa -->
                <div class="modal fade" id="editSiswa<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="action/action_siswa.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" name="aksi" value="edit">
                          <input type="hidden" name="id" value="<?= $row['id_siswa'] ?>">
                          <div class="mb-3">
                            <label for="id_siswa" class="form-label">Nama Siswa</label>

                            <select id="id_siswa" name="id_user" class="form-select" aria-label="Default select example">
                              <option value="<?= $row['id_user'] ?>" selected><?= $row['nama_siswa'] ?></option>
                              <?php
                              $query_users  = "SELECT * FROM users WHERE role = 'Siswa'";
                              $result_users = mysqli_query($koneksi, $query_users);
                              while ($row_users = mysqli_fetch_array($result_users)):
                                ?>
                                <option value="<?= $row_users['id_user'] ?>"><?= $row_users['nama_lengkap'] ?></option>
                                <?php
                              endwhile;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" value="<?= $row['nis'] ?>" name="nis" placeholder="Masukkan NIS">
                          </div>
                          <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $row['nama_siswa'] ?>" name="nama_siswa" placeholder="Masukkan Nama Anda">
                          </div>
                          <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select id="id_kelas" name="kelas" class="form-select" aria-label="Default select example">
                              <option value="<?= $row['id_kelas'] ?>" disabled>Pilih Kelas</option>
                              <?php
                              $query_kelas  = "SELECT * FROM kelas";
                              $result_kelas = mysqli_query($koneksi, $query_kelas);
                              while ($row_kelas = mysqli_fetch_array($result_kelas)):
                                ?>
                                <option value="<?= $row_kelas['id_kelas'] ?>"><?= $row_kelas['nama_kelas'] ?> - <?= $row_kelas['jurusan'] ?></option>
                                <?php
                              endwhile;
                              ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" value="<?=$row['tgl_lahir']?>" name="tgl_lahir" placeholder="Masukkkan Tanggal Lahir Siswa">
                          </div>
                          <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
                              <option value="<?= $row ['jenis_kelamin'] ?>" disabled>Pilih Jenis Kelamin</option>
                              <option value="L">Laki-laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" value="<?= $row['alamat'] ?>" name="alamat" placeholder="Masukkkan Alamat Siswa">
                          </div>
                          <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="number" class="form-control" id="no_hp" value="<?= $row['no_hp'] ?>" name="no_hp" placeholder="Masukkkan Nomor HP Siswa">
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
<div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="action/action_siswa.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="aksi" value="tambah">
          <div class="mb-3">
            <label for="id_siswa" class="form-label">Nama Siswa</label>

            <select id="id_siswa" name="id_user" class="form-select" aria-label="Default select example">
              <option selected disabled>-- Pilih Nama Siswa --</option>
              <?php
              $query_users  = "SELECT * FROM users WHERE role = 'Siswa'";
              $result_users = mysqli_query($koneksi, $query_users);
              while ($row_users = mysqli_fetch_array($result_users)):
                ?>
                <option value="<?= $row_users['id_user'] ?>"><?= $row_users['nama_lengkap'] ?></option>
                <?php
              endwhile;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
          </div>
          <div class="mb-3">
            <label for="nama_siswa" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Anda">
          </div>
          <div class="mb-3">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select id="id_kelas" name="kelas" class="form-select" aria-label="Default select example">
              <option selected disabled>-- Pilih Kelas --</option>
              <?php
              $query_kelas  = "SELECT * FROM kelas";
              $result_kelas = mysqli_query($koneksi, $query_kelas);
              while ($row_kelas = mysqli_fetch_array($result_kelas)):
                ?>
                <option value="<?= $row_kelas['id_kelas'] ?>"><?= $row_kelas['nama_kelas'] ?> - <?= $row_kelas['jurusan'] ?></option>
                <?php
              endwhile;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkkan Tanggal Lahir Siswa">
          </div>
          <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" aria-label="Default select example">
              <option selected disabled>-- Pilih Jenis Kelamin --</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkkan Alamat Siswa">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkkan Nomor HP Siswa">
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

