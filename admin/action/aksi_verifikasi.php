<?php
include("../../koneksi.php");

if (isset($_GET['aksi'])) {
    $aksi    = $_GET['aksi'];
    $id_izin = $_GET['id_izin'];

    if ($aksi == 'setujui') {
        $query = "UPDATE izin SET status = 'disetujui' WHERE id_izin = '$id_izin'";
        mysqli_query($koneksi, $query);
        header("Location: ../index.php?menu=data_verifikasi&pesan=disetujui");
        exit;
    } elseif ($aksi == 'tolak') {
        $query = "UPDATE izin SET status = 'ditolak' WHERE id_izin = '$id_izin'";
        mysqli_query($koneksi, $query);
        header("Location: ../index.php?menu=data_verifikasi&pesan=ditolak");
        exit;
    }
}

// Jika tidak ada aksi valid, kembali ke halaman verifikasi
header("Location: ../index.php?menu=data_verifikasi");
exit;
