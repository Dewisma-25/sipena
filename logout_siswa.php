<?php
session_start();
include("koneksi.php");
session_destroy();
header("Location: login_sipena.php?pesan=logout");