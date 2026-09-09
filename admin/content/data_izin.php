<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">Data Izin Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Izin Siswa</li>
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
                + Tambah Izin
            </button>

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
                                <th scope="col">Alasan</th>
                                <th scope="col">File</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Dibuat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_users = "SELECT i.*, s.nama_siswa, j.nama_jenis 
                                FROM izin i 
                                LEFT JOIN siswa s ON i.id_siswa = s.id_siswa 
                                LEFT JOIN jenis_izin j ON i.id_jenis = j.id_jenis"; //memilihh data
                            $result_users = mysqli_query($koneksi, $query_users); //koneksi ke database + milih data
                            while ($row = mysqli_fetch_array($result_users)) : // perulangan
                            ?>
                                <tr>
                                    <th scope="row"><?= $row['id_izin'] ?></th>
                                    <td><?= $row['nama_siswa'] ?></td>
                                    <td><?= $row['nama_jenis'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['alasan'] ?></td>
                                    <td>
                                        <a href="uploads/<?= $row['file_surat'] ?>" class="btn btn-sm btn-info" style="background:#1DCED8;" target="_blank">
                                            <i class="bi bi-card-image"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 'menunggu') {  ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php } ?>
                                        <?php if ($row['status'] == 'disetujui') {  ?>
                                            <span class="badge bg-success">Disetujui</span>
                                        <?php } ?>
                                        <?php if ($row['status'] == 'ditolak') {  ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $row['tgl_dibuat'] ?></td>
                                    <td>
                                        <div class="aksi d-flex gap-1">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $row['id_izin'] ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" id="hapus<?= $row['id_izin']  ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <script>
                                                document.getElementById("hapus<?= $row['id_izin'] ?>").addEventListener("click", function(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: "Apa Kamu Yakin?",
                                                        text: "Anda Tidak Bisa Mengembalikan Data Yang Sudah Dihapus!",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#3085d6",
                                                        cancelButtonColor: "#d33",
                                                        confirmButtonText: "Ya, Hapus Data Ini!"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            window.location.href = "action/aksi_izin.php?aksi=hapus&id_izin=<?= $row['id_izin'] ?>"
                                                        };
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </td>
                                    <!-- tombol edit dan hapus -->
                                </tr>

                                <!-- Modal edit  -->
                                <!-- Modal -->
                                <div class="modal fade" id="edit<?= $row['id_izin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Izin</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="action/aksi_izin.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="aksi" value="edit">
                                                    <input type="hidden" name="id_izin" value="<?= $row['id_izin'] ?>">

                                                    <div class="mb-3">
                                                        <label for="edit_siswa<?= $row['id_izin'] ?>" class="form-label">Nama Siswa</label>
                                                        <select name="id_siswa" id="edit_siswa<?= $row['id_izin'] ?>" class="form-select" required>
                                                            <?php
                                                            $query_s  = "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa ASC";
                                                            $result_s = mysqli_query($koneksi, $query_s);
                                                            while ($row_s = mysqli_fetch_array($result_s)) :
                                                            ?>
                                                                <option value="<?= $row_s['id_siswa'] ?>" <?= ($row_s['id_siswa'] == $row['id_siswa']) ? 'selected' : '' ?>>
                                                                    <?= $row_s['nama_siswa'] ?>
                                                                </option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="edit_jenis<?= $row['id_izin'] ?>" class="form-label">Jenis Izin</label>
                                                        <select name="id_jenis" id="edit_jenis<?= $row['id_izin'] ?>" class="form-select" required>
                                                            <?php
                                                            $query_j  = "SELECT id_jenis, nama_jenis FROM jenis_izin ORDER BY nama_jenis ASC";
                                                            $result_j = mysqli_query($koneksi, $query_j);
                                                            while ($row_j = mysqli_fetch_array($result_j)) :
                                                            ?>
                                                                <option value="<?= $row_j['id_jenis'] ?>" <?= ($row_j['id_jenis'] == $row['id_jenis']) ? 'selected' : '' ?>>
                                                                    <?= $row_j['nama_jenis'] ?>
                                                                </option>
                                                            <?php endwhile; ?>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal" required value="<?= $row['tanggal'] ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Waktu Mulai</label>
                                                        <input type="time" class="form-control" name="waktu_mulai" required value="<?= $row['waktu_mulai'] ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Waktu Selesai</label>
                                                        <input type="time" class="form-control" name="waktu_selesai" required value="<?= $row['waktu_selesai'] ?>">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Alasan</label>
                                                        <textarea class="form-control" rows="3" name="alasan" required><?= $row['alasan'] ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">File Surat</label>
                                                        <input type="file" class="form-control" name="file_surat">
                                                        <?php if (!empty($row['file_surat'])): ?>
                                                            <small class="text-muted d-block mt-1">File saat ini: <strong><?= $row['file_surat'] ?></strong> (Kosongkan jika tidak ingin mengubah file)</small>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select name="status" class="form-select" required>
                                                            <option value="menunggu" <?= ($row['status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                                            <option value="disetujui" <?= ($row['status'] == 'disetujui') ? 'selected' : '' ?>>Disetujui</option>
                                                            <option value="ditolak" <?= ($row['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                                                        </select>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
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
    </div>
    <!--end::Container-->
    <!--end::App Content-->
</main>

<!-- Modal TAMBAH -->
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Izin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form tambah user -->
                <form action="action/aksi_izin.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <!-- value tambah -->
                        <input type="text" hidden name="aksi" value="tambah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="siswa" class="form-label">Nama Siswa</label>
                        <select name="id_siswa" class="form-select" aria-label="Default select example">
                            <option selected disabled>-- Pilih Siswa --</option>
                            <?php
                            $query = "SELECT s.id_siswa, s.nama_siswa FROM siswa s";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?= $row['id_siswa'] ?>"><?= $row['nama_siswa'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_izin" class="form-label">Jenis Izin</label>
                        <select name="id_jenis" class="form-select" aria-label="Default select example">
                            <option selected disabled>-- Pilih Jenis Izin --</option>
                            <?php
                            $query = "SELECT j.id_jenis, j.nama_jenis FROM jenis_izin j";
                            $result = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?= $row['id_jenis'] ?>"><?= $row['nama_jenis'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai">
                    </div>
                    <div class="mb-3">
                        <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai">
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="alasan" rows="3" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Alasan</label>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file_surat">
                        <small> (.jpg, .jpeg, .png) </small>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" aria-label="Default select example">
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
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