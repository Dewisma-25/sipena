<?php
include ('../../koneksi.php');
$aksi = $_POST['aksi'];

if ($aksi == "tambah") {

$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$role = $_POST['role'];

$query = "INSERT INTO users VALUES (NULL, '$username', '$password', '$nama', '$email', '$no_hp', '$role')";

$result = mysqli_query($koneksi, $query);

    header("location: ../index.php?menu=data_user");
}
