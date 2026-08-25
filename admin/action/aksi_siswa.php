<?php
include('../../koneksi.php');

$aksi = $_POST['aksi'];

if ($aksi = $_POST['aksi']) {
    if ($aksi == 'tambah') {
        $id_user = $_POST['id_user'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        $query = "INSERT INTO siswa (id_user, nis, nama_siswa, id_kelas, tgl_lahir, jenis_kelamin, alamat, no_hp )
                    VALUES ('$id_user', '$nis', '$nama', '$kelas', '$tgl_lahir', '$jenis_kelamin', '$alamat', '$no_hp')";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_siswa&pesan=berhasil");
    } elseif ($aksi == 'edit') {
        $id = $_POST['id'];
        $id_user = $_POST['id_user'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        $query = "UPDATE siswa SET
                  id_user = '$id_user',
                  nis = '$nis',
                  nama_siswa = '$nama',
                  id_kelas = '$kelas',
                  tgl_lahir = '$tgl_lahir',
                  jenis_kelamin = '$jenis_kelamin',
                  alamat = '$alamat',
                  no_hp = '$no_hp'
                  WHERE id_siswa = '$id'  ";

        mysqli_query($koneksi, $query);

        header("location: ../index.php?menu=data_siswa&pesan=edit");
    }
}

if ($aksi = $_GET['aksi']) {
    $id = $_GET['id_siswa'];

    $query = "DELETE FROM siswa WHERE id_siswa = $id";

    $result = mysqli_query($koneksi, $query);

    header("location: ../index.php?menu=data_siswa&pesan=hapus");
}