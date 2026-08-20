<?php
include("../../koneksi.php");
$aksi = $_POST['aksi'];
if ($aksi == 'tambah') {
    $nama_kelas = $_POST['nama_kelas'];
    $jurusan = $_POST['jurusan'];
    $tingkat = $_POST['tingkat'];
    $wali_kelas = $_POST['wali_kelas'];

    $query = "INSERT INTO kelas (nama_kelas, jurusan, tingkat, wali_kelas) VALUES ('$nama_kelas', '$jurusan', '$tingkat', '$wali_kelas')";

    mysqli_query($koneksi, $query);

    header("location: ../index.php?menu=data_kelas&pesan=berhasil");
} elseif ($aksi == 'edit') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jurusan = $_POST['jurusan'];
    $tingkat = $_POST['tingkat'];
    $wali_kelas = $_POST['wali_kelas'];

    $query = "UPDATE kelas SET
            nama_kelas = '$nama_kelas',
            jurusan = '$jurusan',
            tingkat = '$tingkat',
            wali_kelas = '$wali_kelas'
            WHERE id_kelas = '$id_kelas'";

    mysqli_query($koneksi, $query);

    header("location: ../index.php?menu=data_kelas&pesan=edit");
}
