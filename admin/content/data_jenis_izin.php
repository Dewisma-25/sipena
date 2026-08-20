      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Data Jenis Izin</h1>

              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Jenis Izin</li>
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
              + Tambah Jenis Izin
            </button>
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nama Izin</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query_jenis_izin = "SELECT * FROM jenis_izin";
                    $result_jenis_izin = mysqli_query($koneksi, $query_jenis_izin);
                    while ($row = mysqli_fetch_array($result_jenis_izin)) :
                    ?>
                      <tr>
                        <th scope="row"><?= $row['id_jenis'] ?></th>
                        <td><?= $row['nama_jenis'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td>
                          <div class="aksi">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJenisIzin<?= $row['id_jenis'] ?>">
                              <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger">
                              <i class="bi bi-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <!-- Modal edit  -->
                      <!-- Modal -->
                      <div class="modal fade modal-lg" id="editJenisIzin<?= $row['id_jenis'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Jenis Izin</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <!-- form tambah user -->
                              <form action="./action/aksi_jenis_izin.php" method="POST">
                                <input type="text" value="edit" name="aksi" hidden>
                                <div class="mb-3">
                                  <label for="id" class="form-label">ID</label>
                                  <input type="text" value="<?= $row['id_jenis'] ?>" class="form-control" id="id" name="id_jenis" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="nama_jenis" class="form-label">Nama Jenis Izin</label>
                                  <input value="<?= $row['nama_jenis'] ?>" type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="Masukkan Nama Jenis Izin">
                                </div>
                                <div class="mb-3">
                                  <label for="deskripsi" class="form-label">Deskripsi</label>
                                  <input value="<?= $row['deskripsi'] ?>" type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Jenis Izin</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- form tambah user -->
              <form action="./action/aksi_jenis_izin.php" method="POST">
                <input type="text" value="tambah" name="aksi" hidden>
                <div class="mb-3">
                  <label for="nama_jenis" class="form-label">Nama Jenis Izin</label>
                  <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="Masukkan Nama Jenis Izin">
                </div>
                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
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