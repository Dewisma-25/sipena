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
                    while($row = mysqli_fetch_array($result_kelas)) :
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