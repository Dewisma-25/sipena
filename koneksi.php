<?php
//konfigurasi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "perizinansiswa";

//koneksi ke database mysql
$koneksi = new mysqli($host, $username, $password, $database);

//antisipasi kalo gagal koneksi
if ($koneksi->connect_error) {
    die("koneksi gagal: " . $koneksi->connect_error);
}
?>