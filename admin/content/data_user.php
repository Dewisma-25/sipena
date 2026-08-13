<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data User</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data User</li>
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
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
      + Tambah User
    </button>

    <!--begin::Row-->
    <div class="row">
      <div class="col-lg-12">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Username</th>
              <th scope="col">Password</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Email</th>
              <th scope="col">No Hp</th>
              <th scope="col">Role</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query_users = "SELECT * FROM users"; //memilihh data
            $result_users = mysqli_query($koneksi, $query_users); //koneksi ke database + milih data
            while ($row = mysqli_fetch_array($result_users)) : // perulangan
            ?>
              <tr>
                <th scope="row"><?= $row['id_user'] ?></th>
                <td><?= $row['username'] ?></td>
                <td><?= $row['password'] ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['no_hp'] ?></td>
                <td><?= $row['role'] ?></td>

                <!-- tombol edit dan hapus -->
                <td>
                  <div class="aksi d-flex gap-2">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_user'] ?>">
                      Edit
                    </button>
                    <form action="action/aksi_user.php" method="POST" class="m-0" id="formHapus-<?= $row['id_user'] ?>">
                      <div>
                        <!-- value edit -->
                        <input value="hapus" type="hidden" class="form-control" id="edit" name="aksi" aria-describedby="emailHelp" hidden>

                        <!-- value id_user -->
                        <input value="<?= $row['id_user']  ?>" type="hidden" class="form-control" id="id_user" name="id_user" aria-describedby="emailHelp" hidden>
                      </div>
                      <button onclick="konfirmasiHapus(<?= $row['id_user']  ?>)" type="button" class="btn btn-danger">
                        Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>

              <!-- Modal edit  -->
              <!-- Modal -->
              <div class="modal fade" id="editModal<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- form edit user -->
                      <form action="action/aksi_user.php" method="POST">
                        <div class="mb-3">
                          <!-- value edit -->
                          <input value="edit" type="text" class="form-control" id="edit" name="aksi" aria-describedby="emailHelp" hidden>

                          <!-- value id_user -->
                          <input value="<?= $row['id_user']  ?>" type="text" class="form-control" id="id_user" name="id_user" aria-describedby="emailHelp" hidden>

                          <label for="username" class="form-label">Username</label>
                          <input value="<?= $row['username'] ?>" type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukkan username anda">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input value="<?= $row['password'] ?>" type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukkan password anda">
                        </div>
                        <div class="mb-3">
                          <label for="nama" class="form-label">Nama Lengkap</label>
                          <input value="<?= $row['nama_lengkap'] ?>" type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input value="<?= $row['email'] ?>" type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda">
                        </div>
                        <div class="mb-3">
                          <label for="no_hp" class="form-label">Nomor Hp</label>
                          <input value="<?= $row['no_hp'] ?>" type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Hp anda">
                        </div>
                        <div class="mb-3">
                          <select name="role" class="form-select" aria-label="Default select example">
                            <option selected disabled>-- Pilih Role --</option>
                            <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="guru" <?= $row['role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                            <option value="siswa" <?= $row['role'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
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
            endwhile; //penutup perulangan
              ?>
          </tbody>
        </table>
      </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <!-- /.row (main row) -->
  </div>
  </div>
  <!--end::Container-->
  <!--end::App Content-->
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form tambah user -->
        <form action="action/aksi_user.php" method="POST">
          <div class="mb-3">
            <!-- value tambah -->
            <input type="text" hidden name="aksi" value="tambah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukkan username anda">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukkan password anda">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anda">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email anda">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Hp</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Hp anda">
          </div>
          <div class="mb-3">
            <select name="role" class="form-select" aria-label="Default select example">
              <option selected disabled>-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="guru">Guru</option>
              <option value="siswa">Siswa</option>
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