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
                <table class="table table-striped table-hover">
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
                    $query_siswa = "SELECT 
                                      siswa.id_siswa,
                                      siswa.id_user,
                                      siswa.nis,
                                      siswa.nama_siswa,
                                      kelas.nama_kelas,
                                      siswa.id_kelas,
                                      siswa.tgl_lahir,
                                      siswa.jenis_kelamin,
                                      siswa.alamat,
                                      siswa.no_hp,
                                      users.nama_lengkap
                                      FROM siswa
                                      LEFT JOIN users ON users.id_user = siswa.id_user
                                      LEFT JOIN kelas ON kelas.id_kelas = siswa.id_kelas";

                    $query_user = "SELECT
                                      users.id_user,
                                      users.nama_lengkap
                                      FROM users
                                      WHERE role = 'siswa'";

                    $query_kelas = "SELECT
                                      kelas.id_kelas,
                                      kelas.nama_kelas
                                      FROM kelas";

                    $result_user = mysqli_query($koneksi, $query_user);
                    $users = mysqli_fetch_all($result_user, MYSQLI_ASSOC);
                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                    $data_kelas = mysqli_fetch_all($result_kelas, MYSQLI_ASSOC);

                    $result_siswa = mysqli_query($koneksi, $query_siswa);
                    while ($row = mysqli_fetch_array($result_siswa)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_siswa'] ?></th>
                        <td><?= $row['nama_lengkap'] ?></td>
                        <td><?= $row['nis'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_hp'] ?></td>

                        <td>
                          <div class="aksi d-flex gap-1">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSiswa<?= $row['id_siswa'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger">
                              <i class="bi bi-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <!-- modal edit siswa -->
                      <div class="modal fade modal-lg" id="editSiswa<?= $row['id_siswa'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- form tambah siswa -->
                              <form action="./action/aksi_siswa.php" method="POST">
                                <div class="mb-3">
                                  <!-- value edit -->
                                  <input type="text" hidden name="aksi" value="edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                  <!-- value edit nya -->
                                  <label for="id" class="form-label">ID</label>
                                  <input value="<?= $row['id_siswa'] ?>" type="text" class="form-control" id="id" name="id" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="id_siswa" class="form-label">ID Siswa</label>
                                  <select id="id_siswa" name="id_user" class="form-select" aria-label="Default select example">
                                    <option disabled>-- Pilih Siswa --</option>
                                    <?php foreach ($users as $user) : ?>
                                      <option value="$=<?= $user['id_user'] ?>" <?= $user['id_user'] == $row['id_user'] ? 'selected' : '' ?>><?= $user['nama_lengkap'] ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="nis" class="form-label">Nis</label>
                                  <input value="<?= $row['nis'] ?>" type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan password anda">
                                </div>
                                <div class="mb-3">
                                  <label for="nama" class="form-label">Nama</label>
                                  <input value="<?= $row['nama_siswa'] ?>" type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda">
                                </div>
                                <div class="mb-3">
                                  <label for="id_kelas" class="form-label">Kelas</label>
                                  <select id="id_kelas" name="kelas" class="form-select" aria-label="Default select example">
                                    <option selected disabled>-- Pilih Kelas --</option>
                                    <?php foreach ($data_kelas as $kelas) : ?>
                                      <option value="<?= $kelas['id_kelas'] ?>" <?= $kelas['id_kelas'] == $row['id_kelas'] ? 'selected' : '' ?>><?= $kelas['nama_kelas'] ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                  <input value="<?= $row['tgl_lahir'] ?>" type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkkan Tanggal Lahir Siswa">
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
                                  <input value="<?= $row['alamat'] ?>" type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkkan Alamat Siswa">
                                </div>
                                <div class="mb-3">
                                  <label for="no_hp" class="form-label">No HP</label>
                                  <input value="<?= $row['no_hp'] ?>" type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkkan Nomor HP Siswa">
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
      <?php
      $result_user = mysqli_query($koneksi, $query_user);
      $result_kelas = mysqli_query($koneksi, $query_kelas);
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

                  <select id="id_siswa" name="id_user" class="form-select" aria-label="Default select example">
                    <option selected disabled>-- Pilih ID Siswa --</option>
                    <?php while ($user = mysqli_fetch_array($result_user)) : ?>
                      <option value="<?= $user['id_user'] ?>"><?= $user['nama_lengkap'] ?></option>
                    <?php endwhile ?>
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
                  <select id="id_kelas" name="kelas" class="form-select" aria-label="Default select example">
                    <option selected disabled>-- Pilih Kelas --</option>
                    <?php while ($kelas = mysqli_fetch_array($result_kelas)) : ?>
                      <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                    <?php endwhile ?>
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