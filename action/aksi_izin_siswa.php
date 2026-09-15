<?php
session_start();
include("../koneksi.php");

// Pastikan siswa sudah login
if (!isset($_SESSION['nama_siswa']) || !isset($_SESSION['id_siswa'])) {
    header("Location: ../login_sipena.php?pesan=belum_login");
    exit;
}

if (isset($_POST['aksi'])) {
    $aksi = $_POST['aksi'];

    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if ($aksi == 'tambah') {
        $id_siswa    = $_SESSION['id_siswa']; // Ambil dari session, bukan POST
        $id_jenis    = $_POST['id_jenis'];
        $tanggal     = $_POST['tanggal'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $alasan      = $_POST['alasan'];
        $status      = 'menunggu'; // Default status untuk pengajuan siswa

        // Validasi field wajib
        if (empty($id_jenis) || empty($tanggal) || empty($waktu_mulai) || empty($waktu_selesai) || empty($alasan)) {
            header("Location: ../index.php?pesan=isi_form");
            exit;
        }

        $file_surat = '';
        if (isset($_FILES['file_surat']) && $_FILES['file_surat']['error'] == 0) {
            $allowed_ext = ['jpg', 'jpeg', 'png'];
            $file_ext = strtolower(pathinfo($_FILES['file_surat']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_ext)) {
                header("Location: ../index.php?pesan=format_salah");
                exit;
            }
            $file_name = time() . '_' . basename($_FILES['file_surat']['name']);
            $file_tmp  = $_FILES['file_surat']['tmp_name'];
            move_uploaded_file($file_tmp, $upload_dir . $file_name);
            $file_surat = $file_name;
        }

        $query = "INSERT INTO izin (id_siswa, id_jenis, tanggal, waktu_mulai, waktu_selesai, alasan, file_surat, status) 
                  VALUES ('$id_siswa', '$id_jenis', '$tanggal', '$waktu_mulai', '$waktu_selesai', '$alasan', '$file_surat', '$status')";

        mysqli_query($koneksi, $query);

        header("Location: ../index.php?pesan=berhasil");
        exit;
    }
}

// Jika tidak ada aksi yang valid, redirect ke index
header("Location: ../index.php");
exit;
