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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
              + Tambah Kelas
            </button>
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama Kelas</th>
                      <th scope="col">Jurusan</th>
                      <th scope="col">Tingkat</th>
                      <th scope="col">ID Wali Kelas</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query_kelas = "SELECT
                                      kelas.id_kelas,
                                      kelas.nama_kelas,
                                      kelas.jurusan,
                                      kelas.tingkat,
                                      kelas.wali_kelas,
                                      users.nama_lengkap AS nama_wali_kelas
                                    FROM kelas
                                    LEFT JOIN users
                                    ON users.id_user = kelas.wali_kelas
                                    AND users.role = 'guru' 
                                    ORDER BY kelas.id_kelas DESC";

                    $query_guru = "SELECT 
                                      users.id_user,
                                      users.nama_lengkap
                                      FROM users
                                      WHERE role = 'guru'";

                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                    $result_guru = mysqli_query($koneksi, $query_guru);
                    while ($row = mysqli_fetch_array($result_kelas)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_kelas'] ?></th>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['jurusan'] ?></td>
                        <td><?= $row['tingkat'] ?></td>
                        <td><?= $row['nama_wali_kelas'] ?></td>

                        <td>
                          <div class="aksi">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editkelas<?= $row['id_kelas'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <a class="btn btn-danger" href="#">Hapus</a>
                          </div>
                        </td>
                      </tr>
                      <!-- Modal edit  -->
                      <!-- Modal -->
                      <div class="modal fade modal-lg" id="editkelas<?= $row['id_kelas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kelas</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- form tambah user -->
                              <form action="./action/aksi_kelas.php" method="POST">
                                <div class="mb-3">
                                  <!-- value tambah -->
                                  <input type="text" hidden name="aksi" value="edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                  <label for="id" class="form-label">ID Kelas</label>
                                  <input value="<?= $row['id_kelas'] ?>" type="text" class="form-control" id="id" name="id_kelas" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                  <input value="<?= $row['nama_kelas'] ?>" type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Masukkan Nama kelas">
                                </div>
                                <div class="mb-3">
                                  <label for="jurusan" class="form-label">Jurusan</label>
                                  <input value="<?= $row['jurusan'] ?>" type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan">
                                </div>
                                <div class="mb-3">
                                  <label for="tingkat" class="form-label">Tingkat</label>
                                  <input value="<?= $row['tingkat'] ?>" type="text" class="form-control" id="tingkat" name="tingkat" placeholder="Masukkan Tingkatan">
                                </div>
                                <div class="mb-3">
                                  <label for="wali_kelas" class="form-label">Wali Kelas</label>
                                  <select name="wali_kelas" class="form-select" aria-label="Default select example">
                                    <?php while ($guru = mysqli_fetch_array($result_guru)) : ?>
                                      <option value="<?= $guru['id_user'] ?>" <?= $guru['id_user'] == $row['wali_kelas'] ? 'selected' : '' ?>><?= $guru['nama_lengkap'] ?></option>
                                    <?php endwhile ?>
                                  </select>
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
      <div class="modal fade modal-lg" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form tambah user -->
              <form action="./action/aksi_kelas.php" method="POST">
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
                    <?php $result_guru = mysqli_query($koneksi, $query_guru) ?>
                    <option value="" selected disabled>PILIH WALI KELAS</option>
                    <?php while ($guru = mysqli_fetch_array($result_guru)) : ?>
                      <option value="<?= $guru['id_user'] ?>"><?= $guru['nama_lengkap'] ?></option>
                    <?php endwhile ?>
                  </select>
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