<?php
include("../../koneksi.php");

if ($aksi = $_POST['aksi']) {

    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($aksi == 'tambah') {
        $id_siswa = $_POST['id_siswa'];
        $id_jenis = $_POST['id_jenis'];
        $tanggal = $_POST['tanggal'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $alasan = $_POST['alasan'];
        $status = $_POST['status'];

        $file_surat = '';
        if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
            $file_name = time() . '_' . basename($_FILES['file_surat']['name']);
            $file_tmp = $_FILES['file_surat']['tmp_name'];
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $file_surat = $file_name;
        }

        $query = "INSERT INTO izin (id_siswa,id_jenis,tanggal,waktu_mulai,waktu_selesai,alasan,file_surat,status) 
                  VALUES ('$id_siswa','$id_jenis','$tanggal','$waktu_mulai','$waktu_selesai','$alasan','$file_surat','$status')";

        mysqli_query($koneksi, $query);

        header("Location: ../index.php?menu=data_izin&pesan=berhasil");
    } elseif ($aksi == 'edit') {
        $id = $_POST['id_izin'];
        $id_siswa = $_POST['id_siswa'];
        $id_jenis = $_POST['id_jenis'];
        $tanggal = $_POST['tanggal'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $alasan = $_POST['alasan'];
        $status = $_POST['status'];

        $file_surat = '';
        if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
            $file_name = time() . '_' . basename($_FILES['file_surat']['name']);
            $file_tmp = $_FILES['file_surat']['tmp_name'];
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $file_surat = $file_name;
        }

        if ($file_surat) {
            $query = "UPDATE izin SET
               id_siswa = '$id_siswa',
               id_jenis = '$id_jenis',
               tanggal = '$tanggal',
               waktu_mulai = '$waktu_mulai',
               waktu_selesai = '$waktu_selesai',
               alasan = '$alasan',
               file_surat = '$file_surat',
               status = '$status'
               WHERE id_izin = '$id'";
        } else {
            $query = "UPDATE izin SET
               id_siswa = '$id_siswa',
               id_jenis = '$id_jenis',
               tanggal = '$tanggal',
               waktu_mulai = '$waktu_mulai',
               waktu_selesai = '$waktu_selesai',
               alasan = '$alasan',
               status = '$status'
               WHERE id_izin = '$id'";
        }

        mysqli_query($koneksi, $query);

        header("Location: ../index.php?menu=data_izin&pesan=edit");
    }
}

if ($aksi = $_GET['aksi']) {
    $id = $_GET['id_izin'];

    $query_file = "SELECT file_surat FROM izin WHERE id_izin = $id";
    $result_file = mysqli_query($koneksi, $query_file);
    $row_file = mysqli_fetch_array($result_file);
    if ($row_file && $row_file['file_surat'] && file_exists("../uploads/" . $row_file['file_surat'])) {
        unlink("../uploads/" . $row_file['file_surat']);
    }

    $query = "DELETE FROM izin WHERE id_izin = $id";
    mysqli_query($koneksi, $query);
    header("Location: ../index.php?menu=data_izin&pesan=hapus");
}
