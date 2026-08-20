<?php
include("../../koneksi.php");

$aksi = $_POST['aksi'];

if ($aksi = $_POST['aksi']) {
    if ($aksi == 'tambah') {
        $nama_kelas = $_POST['nama_jenis'];
        $deskripsi = $_POST['deskripsi'];

        $query = "INSERT INTO jenis_izin (nama_jenis, deskripsi) VALUES ('$nama_kelas','$deskripsi')";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_jenis_izin&pesan=berhasil");
    } elseif ($aksi == 'edit') {
        $id = $_POST['id_jenis'];
        $nama_kelas = $_POST['nama_jenis'];
        $deskripsi = $_POST['deskripsi'];

        $query = "UPDATE jenis_izin SET
                    nama_jenis = '$nama_kelas',
                    deskripsi = '$deskripsi'
                    WHERE id_jenis = '$id'";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_jenis_izin&pesan=edit");
    }
}
