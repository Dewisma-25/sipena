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
                    while($row = mysqli_fetch_array($result_siswa)) :
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