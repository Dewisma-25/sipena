<?php
include('../../koneksi.php');
if ($aksi = $_POST['aksi']) {
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
    } elseif ($aksi == 'edit') {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $role = $_POST['role'];

        $query2 = "UPDATE users SET 
            username='$username', 
            password='$password', 
            nama_lengkap='$nama', 
            email='$email', 
            no_hp='$no_hp', 
            role='$role' 
            WHERE id_user='$id_user'";
            
        $result = mysqli_query($koneksi, $query2);

        header("location: ../index.php?menu=data_user");
    } elseif ($aksi == 'hapus') {
        $id_user = $_POST['id_user'];

        $query3 = "DELETE FROM users WHERE id_user = $id_user";
        $result = mysqli_query($koneksi, $query3);

        header("location: ../index.php?menu=data_user");
    }
}
