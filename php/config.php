<?php
$servername = "localhost";
$username = "root";
$password = "";  
$dbname = "classroom_assignment";
$port = 3310;

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 

// echo "Koneksi Berhasil";

?>
