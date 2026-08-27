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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahSiswaModal">
              + Tambah Siswa
            </button>
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-12">
                <table id="example" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama Siswa</th>
                      <th scope="col">Nis</th>
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

                    $query_user = "SELECT
                                      users.id_user,
                                      users.nama_lengkap
                                      FROM users
                                      WHERE role = 'siswa'";

                    $result_siswa = mysqli_query($koneksi, $query_siswa);
                    while ($row = mysqli_fetch_array($result_siswa)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_siswa'] ?></th>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nis'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_hp'] ?></td>

                        <td>
                          <div class="aksi d-flex gap-1">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_siswa'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger" id="hapus<?= $row['id_siswa']  ?>">
                              <i class="bi bi-trash"></i>
                            </button>
                            <script>
                              document.getElementById("hapus<?= $row['id_siswa'] ?>").addEventListener("click", function(event) {
                                event.preventDefault();
                                Swal.fire({
                                  title: "Apa Kamu Yakin?",
                                  text: "Anda Tidak Bisa Mengembalikan Data Yang Sudah Dihapus!",
                                  icon: "warning",
                                  showCancelButton: true,
                                  confirmButtonColor: "#3085d6",
                                  cancelButtonColor: "#d33",
                                  confirmButtonText: "Ya, Hapus Data Ini!"
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                    window.location.href = "action/aksi_siswa.php?aksi=hapus&id_siswa=<?= $row['id_siswa'] ?>"
                                  };
                                });
                              });
                            </script>
                          </div>
                        </td>
                      </tr>
                      <!-- Modal Edit -->
                      <div class="modal fade" id="edit<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="action/aksi_siswa.php" method="post">
                                <!-- untuk mengarahkan ke aksi tambah -->
                                <input type="text" name="aksi" value="edit" id="" hidden>
                                <!-- batas -->
                                <div class="mb-3">
                                  <label for="id" class="form-label">ID Siswa</label>
                                  <input type="number" class="form-control" id="id" value="<?= $row['id_siswa'] ?>" aria-describedby="emailHelp" name="id" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="id_user" class="form-label">ID User</label>
                                  <select name="id_user" class="form-select mb-3" aria-label="Default select example" required>
                                    <option value="<?= $row['id_user'] ?>" disabled>- Pilih Siswa -</option>
                                    <?php
                                    $query_user = "SELECT * FROM users WHERE role = 'siswa'";
                                    $result_user = mysqli_query($koneksi, $query_user);
                                    while ($row_users = mysqli_fetch_array($result_user)) :
                                    ?>
                                      <option value="<?= $row_users['id_user'] ?>"><?= $row_users['nama_lengkap'] ?> - <?= $row_users['username'] ?></option>
                                    <?php endwhile; ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="nis" class="form-label">NIS</label>
                                  <input type="number" class="form-control" id="nis" value="<?= $row['nis'] ?>" aria-describedby="emailHelp" name="nis" required>
                                </div>
                                <div class="mb-3">
                                  <label for="nama" class="form-label">Nama Siswa</label>
                                  <input type="text" class="form-control" id="nama" value="<?= $row['nama_siswa'] ?>" aria-describedby="emailHelp" name="nama" required>
                                </div>
                                <div class="mb-3">
                                  <label for="id_kelas" class="form-label">Kelas</label>
                                  <select name="kelas" class="form-select mb-3" aria-label="Default select example" required>
                                    <option value="<?= $row['id_kelas'] ?>" disabled>- Pilih Kelas -</option>
                                    <?php
                                    $query_kelas = "SELECT * FROM kelas";
                                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                                    while ($row_kelas = mysqli_fetch_array($result_kelas)) :
                                    ?>
                                      <option value="<?= $row_kelas['id_kelas'] ?>"><?= $row_kelas['nama_kelas'] ?> - <?= $row_kelas['jurusan'] ?></option>
                                    <?php endwhile; ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="born" class="form-label">Tanggal Lahir</label>
                                  <input type="date" class="form-control" id="email" value="<?= $row['tgl_lahir'] ?>" aria-describedby="emailHelp" name="tgl_lahir" required>
                                </div>
                                <div class="mb-3">
                                  <label for="gender" class="form-label">Jenis Kelamin</label>
                                  <select name="jenis_kelamin" class="form-select mb-3" aria-label="Default select example" required>
                                    <option value="<?= $row['jenis_kelamin'] ?>" disabled>- Pilih Jenis Kelamin -</option>
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="alamat" class="form-label">Alamat</label>
                                  <input type="text" class="form-control" id="alamat" value="<?= $row['alamat'] ?>" aria-describedby="emailHelp" name="alamat" required>
                                </div>
                                <div class="mb-3">
                                  <label for="no" class="form-label">No. Telepon</label>
                                  <input type="number" class="form-control" id="no" value="<?= $row['no_hp'] ?>" aria-describedby="emailHelp" name="no_hp" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
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
      <?php
      $result_user = mysqli_query($koneksi, $query_user);
      ?>
      <div class="modal fade modal-lg" id="tambahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form tambah siswa -->
              <form action="./action/aksi_siswa.php" method="POST">
                <div class="mb-3">
                  <!-- value tambah -->
                  <input type="text" hidden name="aksi" value="tambah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="id_siswa" class="form-label">ID Siswa</label>

                  <select id="id_siswa" name="id_user" class="form-select mb-3" aria-label="Default select example" required>
                    <option selected disabled>- Pilih Siswa -</option>
                    <?php
                    $query_user = "SELECT * FROM users WHERE role = 'siswa'";
                    $result_user = mysqli_query($koneksi, $query_user);
                    while ($row_user = mysqli_fetch_array($result_user)) :
                    ?>
                      <option value="<?= $row_user['id_user'] ?>"><?= $row_user['nama_lengkap'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="nis" class="form-label">Nis</label>
                  <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan password anda">
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda">
                </div>
                <div class="mb-3">
                  <label for="id_kelas" class="form-label">Kelas</label>
                  <select name="kelas" class="form-select mb-3" aria-label="Default select example" required>
                    <option selected disabled>- Pilih Kelas -</option>
                    <?php
                    $query_kelas = "SELECT * FROM kelas";
                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                    while ($row_kelas = mysqli_fetch_array($result_kelas)) :
                    ?>
                      <option value="<?= $row_kelas['id_kelas'] ?>"><?= $row_kelas['nama_kelas'] ?> - <?= $row_kelas['jurusan'] ?></option>
                    <?php endwhile; ?>
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
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
        </div>
      </div>