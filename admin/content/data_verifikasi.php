<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Verifikasi Izin</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Verifikasi Izin</li>
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

      <?php
      // Alert bootstrap berdasarkan parameter pesan
      if (isset($_GET['pesan'])) :
        $pesan = $_GET['pesan'];
        if ($pesan == 'disetujui') :
      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><i class="bi bi-check-circle-fill me-1"></i>Berhasil!</strong> Pengajuan izin telah <strong>disetujui</strong>.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php elseif ($pesan == 'ditolak') : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong><i class="bi bi-x-circle-fill me-1"></i>Berhasil!</strong> Pengajuan izin telah <strong>ditolak</strong>.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php endif; ?>

      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="example" class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Jenis Izin</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Waktu</th>
                <th scope="col">Alasan</th>
                <th scope="col">File Surat</th>
                <th scope="col">Status</th>
                <th scope="col">Tgl Dibuat</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query_izin = "SELECT i.*, s.nama_siswa, j.nama_jenis
                             FROM izin i
                             LEFT JOIN siswa s ON i.id_siswa = s.id_siswa
                             LEFT JOIN jenis_izin j ON i.id_jenis = j.id_jenis
                             ORDER BY i.tgl_dibuat DESC";
              $result_izin = mysqli_query($koneksi, $query_izin);
              while ($row = mysqli_fetch_array($result_izin)) :
              ?>
                <tr>
                  <th scope="row"><?= $row['id_izin'] ?></th>
                  <td><?= $row['nama_siswa'] ?></td>
                  <td><?= $row['nama_jenis'] ?></td>
                  <td><?= $row['tanggal'] ?></td>
                  <td><?= $row['waktu_mulai'] ?> - <?= $row['waktu_selesai'] ?></td>
                  <td><?= $row['alasan'] ?></td>
                  <td>
                    <?php if (!empty($row['file_surat'])) : ?>
                      <a href="uploads/<?= $row['file_surat'] ?>" class="btn btn-sm btn-info" style="background:#1DCED8;" target="_blank">
                        <i class="bi bi-card-image"></i>
                      </a>
                    <?php else : ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if ($row['status'] == 'menunggu') : ?>
                      <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php elseif ($row['status'] == 'disetujui') : ?>
                      <span class="badge bg-success">Disetujui</span>
                    <?php elseif ($row['status'] == 'ditolak') : ?>
                      <span class="badge bg-danger">Ditolak</span>
                    <?php endif; ?>
                  </td>
                  <td><?= $row['tgl_dibuat'] ?></td>
                  <td>
                    <div class="d-flex gap-2">
                      <?php if ($row['status'] == 'menunggu') : ?>
                        <!-- Tombol Setujui -->
                        <button type="button" class="btn btn-success btn-sm"
                          id="setujui-<?= $row['id_izin'] ?>"
                          title="Setujui izin ini">
                          <i class="bi bi-check-lg"></i>
                        </button>
                        <script>
                          document.getElementById("setujui-<?= $row['id_izin'] ?>").addEventListener("click", function () {
                            Swal.fire({
                              title: "Setujui Izin?",
                              text: "Anda akan menyetujui izin dari <?= addslashes($row['nama_siswa']) ?>.",
                              icon: "question",
                              showCancelButton: true,
                              confirmButtonColor: "#198754",
                              cancelButtonColor: "#6c757d",
                              confirmButtonText: "Ya, Setujui!",
                              cancelButtonText: "Batal"
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.href = "action/aksi_verifikasi.php?aksi=setujui&id_izin=<?= $row['id_izin'] ?>";
                              }
                            });
                          });
                        </script>

                        <!-- Tombol Tolak -->
                        <button type="button" class="btn btn-danger btn-sm"
                          id="tolak-<?= $row['id_izin'] ?>"
                          title="Tolak izin ini">
                          <i class="bi bi-x-lg"></i>
                        </button>
                        <script>
                          document.getElementById("tolak-<?= $row['id_izin'] ?>").addEventListener("click", function () {
                            Swal.fire({
                              title: "Tolak Izin?",
                              text: "Anda akan menolak izin dari <?= addslashes($row['nama_siswa']) ?>.",
                              icon: "warning",
                              showCancelButton: true,
                              confirmButtonColor: "#dc3545",
                              cancelButtonColor: "#6c757d",
                              confirmButtonText: "Ya, Tolak!",
                              cancelButtonText: "Batal"
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.href = "action/aksi_verifikasi.php?aksi=tolak&id_izin=<?= $row['id_izin'] ?>";
                              }
                            });
                          });
                        </script>
                      <?php else : ?>
                        <span class="text-muted fst-italic small">Sudah diverifikasi</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>

<?php
// SweetAlert otomatis muncul berdasarkan parameter pesan
if (isset($_GET['pesan'])) :
  $pesan = $_GET['pesan'];
?>
<script>
  <?php if ($pesan == 'disetujui') : ?>
    Swal.fire({
      title: "Berhasil!",
      icon: "success",
      text: "Izin berhasil disetujui."
    });
  <?php elseif ($pesan == 'ditolak') : ?>
    Swal.fire({
      title: "Berhasil!",
      icon: "info",
      text: "Izin telah ditolak."
    });
  <?php endif; ?>
</script>
<?php endif; ?>