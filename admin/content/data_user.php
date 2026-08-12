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
      <button type="button" class="btn btn-primary mb-3 " data-bs-toggle="modal" data-bs-target="#tambah-user">+ Tambah User</button>


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

                  <td>
                    <div class="aksi">
                      <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit<?= $row['id_user'] ?>"> <i class="bi bi-pencil-square"></i>Edit</button>
                      <button class="btn btn-danger"> <i class="bi bi-trash3"></i>Hapus</button>
                    </div>
                  </td>
                </tr>

                <!-- Modal edit user -->
                <div class="modal fade" id="modaledit<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- form -->
                        <form action="action/aksi_user.php" method="POST">
                          <!-- untuk mengarah ke aksi tambah -->
                          <input type="text" name="aksi" id="" value="tambah" hidden>

                          <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" id="username" value="<?= $row['username'] ?>" placeholder="Masukkan username anda" required aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" value="<?= $row['password'] ?>" placeholder="Masukkan password anda" required aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input name="nama" type="text" class="form-control" id="nama" value="<?= $row['nama_lengkap'] ?>" placeholder="Masukkan nama lengkap anda" required aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email" value="<?= $row['email'] ?>"  placeholder="Masukkan email anda" required aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Hp</label>
                            <input name="no_hp" type="number" class="form-control" id="no_hp" value="<?= $row['no_hp'] ?>" placeholder="Masukkan no hp anda" required aria-describedby="emailHelp">
                          </div>
                          <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" aria-label="Default select example" required>
                              <option selected disabled>-Pilih Role-</option>
                              <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                              <option value="guru" <?= $row['role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                              <option value="siswa" <?= $row['role'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                            </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
                        <a type="submit" class="btn btn-primary">Simpan</a>
                        </form>
                      </div>
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
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>

<!-- Modal -->
<div class="modal fade" id="tambah-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- form -->
        <form action="action/aksi_user.php" method="POST">
          <!-- untuk mengarah ke aksi tambah -->
          <input type="text" name="aksi" id="" value="tambah" hidden>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="Masukkan username anda" required aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan password anda" required aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input name="nama" type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap anda" required aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Masukkan email anda" required aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Hp</label>
            <input name="no_hp" type="number" class="form-control" id="no_hp" placeholder="Masukkan no hp anda" required aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" aria-label="Default select example" required>
              <option selected disabled>-Pilih Role-</option>
              <option value="admin">Admin</option>
              <option value="guru">Guru</option>
              <option value="siswa">Siswa</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</a>
        <a type="submit" class="btn btn-primary">Simpan</a>
        </form>
      </div>
    </div>
  </div>
</div>