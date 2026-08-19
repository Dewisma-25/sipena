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
                    $query_kelas = "SELECT * FROM kelas";
                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                    while ($row = mysqli_fetch_array($result_kelas)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_kelas'] ?></th>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td><?= $row['jurusan'] ?></td>
                        <td><?= $row['tingkat'] ?></td>
                        <td><?= $row['wali_kelas'] ?></td>

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
      <div class="modal fade modal-lg" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form tambah user -->
              <form action="#" method="POST">
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
                    <option selected disabled>-- Pilih Wali Kelas --</option>
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