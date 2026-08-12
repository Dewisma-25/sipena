<?php
//cek parameter get
if (isset($_GET['menu'])) {
$menu = $_GET['menu'];

//menyertakan halaman yang dipilih
switch($menu) {
    case 'beranda':
        include 'content/beranda.php'; //menampilkan halaman berandanya
        break;
    case 'data_user':
        include 'content/data_user.php'; //menampilkan halaman data user
        break;
    case 'data_siswa':
        include 'content/data_siswa.php'; //menampilkan halaman data user
        break;
    case 'data_kelas':
        include 'content/data_kelas.php'; //menampilkan halaman data kelas
        break;
    case 'data_jenis_izin':
        include 'content/data_jenis_izin.php'; //menampilkan halaman data jenis izin
        break;
}
} else {
        include 'content/beranda.php';
}


?>