<?php
// include koneksi
session_start();
if (!isset($_SESSION['nama_siswa'])) {
    header("Location: login_sipena.php?pesan=belum_login");
    exit;
}

include("koneksi.php");

// Statistik card berdasarkan siswa yang login
$id_siswa_login = $_SESSION['id_siswa'] ?? 0;

$q_total   = "SELECT COUNT(*) as total FROM izin WHERE id_siswa = '$id_siswa_login'";
$q_menunggu  = "SELECT COUNT(*) as total FROM izin WHERE id_siswa = '$id_siswa_login' AND status = 'menunggu'";
$q_diterima  = "SELECT COUNT(*) as total FROM izin WHERE id_siswa = '$id_siswa_login' AND status = 'disetujui'";
$q_ditolak   = "SELECT COUNT(*) as total FROM izin WHERE id_siswa = '$id_siswa_login' AND status = 'ditolak'";

$r_total   = mysqli_fetch_assoc(mysqli_query($koneksi, $q_total));
$r_menunggu  = mysqli_fetch_assoc(mysqli_query($koneksi, $q_menunggu));
$r_diterima  = mysqli_fetch_assoc(mysqli_query($koneksi, $q_diterima));
$r_ditolak   = mysqli_fetch_assoc(mysqli_query($koneksi, $q_ditolak));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                SIPENA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout_siswa.php">Logout</a>
                    </li>
                </ul>
                <h5 class="text-white pe-4">Sistem Perizinan Siswa</h5>
            </div>
        </div>
    </nav>
    <!-- BATAS NAVBAR -->


    <!-- HEADER -->
    <div class="container mt-4">
        <header class="alert alert-dark p-4">
            <h1><?= $_SESSION['nama_siswa'] ?></h1>
            <?php 
            $id = $_SESSION['id_kelas'];
                $q_kelas = "SELECT k.nama_kelas FROM kelas k WHERE id_kelas = '$id' ";
                $r_kelas = mysqli_fetch_assoc(mysqli_query($koneksi, $q_kelas));
            ?>
            <h4><?= $r_kelas['nama_kelas'] ?></h4>
            <h3>SMK PARIWISARA TRIATMA JAYA BADUNG</h3>
        </header>
    </div>
    <!-- BATAS HEADER -->


    <!-- INFO -->
    <div class="container">
        <?php if (isset($_GET['pesan'])): ?>
        <div class="alert <?= ($_GET['pesan'] == 'berhasil') ? 'alert-success' : 'alert-danger' ?> alert-dismissible fade show" role="alert">
            <?php if ($_GET['pesan'] == 'berhasil'): ?>
                <strong>Berhasil!</strong> Pengajuan izin Anda telah berhasil dikirim.
            <?php elseif ($_GET['pesan'] == 'isi_form'): ?>
                <strong>Gagal!</strong> Harap isi semua field yang wajib diisi.
            <?php elseif ($_GET['pesan'] == 'format_salah'): ?>
                <strong>Gagal!</strong> Format file tidak valid. Gunakan format .jpg, .jpeg, atau .png.
            <?php else: ?>
                <strong>Gagal!</strong> Terjadi kesalahan, silakan coba lagi.
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="row ">
            <div class="col-lg-3">
                <div class="alert alert-info text-center">
                    <h1><?= $r_total['total'] ?></h1>
                    <h6>AJUAN</h6>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="alert alert-warning text-center">
                    <h1><?= $r_menunggu['total'] ?></h1>
                    <h6>MENUNGGU</h6>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="alert alert-success text-center">
                    <h1><?= $r_diterima['total'] ?></h1>
                    <h6>DITERIMA</h6>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="alert alert-danger text-center">
                    <h1><?= $r_ditolak['total'] ?></h1>
                    <h6>DITOLAK</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- BATAS INFO -->


        <!-- SECTION -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header alert alert-info fw-bold">
                            + PENGAJUAN IZIN
                        </div>
                        <div class="card-body">
                            <!-- form pengajuan izin -->
                            <form action="action/aksi_izin_siswa.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="aksi" value="tambah">
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
                        </div>
                        <div class="modal-footer gap-2 m-3">
                            <input type="submit" value="ajukan" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header alert alert-info fw-bold">
                            Data Izin
                        </div>
                        <div class="card-body">
                            <!-- data table -->
                            <table id="example" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Jenis Izin</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Alasan</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_users = "SELECT i.*, s.nama_siswa, j.nama_jenis 
                                    FROM izin i 
                                    LEFT JOIN siswa s ON i.id_siswa = s.id_siswa 
                                    LEFT JOIN jenis_izin j ON i.id_jenis = j.id_jenis
                                    WHERE i.id_siswa = '$id_siswa_login'
                                    ORDER BY i.tgl_dibuat DESC"; //menampilkan data izin siswa yang login saja
                                    $result_users = mysqli_query($koneksi, $query_users); //koneksi ke database + milih data
                                    while ($row = mysqli_fetch_array($result_users)) : // perulangan
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $row['id_izin'] ?></th>
                                            <td><?= $row['nama_jenis'] ?></td>
                                            <td><?= $row['tanggal'] ?></td>
                                            <td><?= $row['alasan'] ?></td>
                                            <td>
                                                <a href="admin/uploads/<?= $row['file_surat'] ?>" class="btn btn-sm btn-info" style="background:#1DCED8;" target="_blank">
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
                </div>
            </div>
        </div>
        <!-- SECTION -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>