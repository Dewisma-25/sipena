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
                      <th scope="col">ID User</th>
                      <th scope="col">Nis</th>
                      <th scope="col">Nama</th>
                      <th scope="col">ID Kelas</th>
                      <th scope="col">Tanggal Lahir</th>
                      <th scope="col">Jenis Kelamin</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query_siswa = "SELECT * FROM siswa";
                    $result_siswa = mysqli_query($koneksi, $query_siswa);
                    while ($row = mysqli_fetch_array($result_siswa)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_siswa'] ?></th>
                        <td><?= $row['id_user'] ?></td>
                        <td><?= $row['nis'] ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['id_kelas'] ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['jenis_kelamin'] ?></td>
                        <td><?= $row['alamat'] ?></td>

                        <td>
                          <div class="aksi">
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a class="btn btn-danger" href="#">Hapus</a>
                          </div>
                        </td>
                      </tr>
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
      <div class="modal fade modal-lg" id="tambahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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