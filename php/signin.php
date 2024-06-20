<?php
session_start();
include 'config.php';  // Pastikan jalur ini benar, sesuaikan dengan struktur folder Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk mendapatkan password dari database berdasarkan email
    $sql = "SELECT email, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        if ($password === $stored_password) {  // Periksa password langsung (plaintext)
            $_SESSION['email'] = $row['email'];
            header("Location: ../index.html"); 
            exit();
        } else {
            echo "Password salah";
        }
    } else {
        echo "Email tidak ditemukan";
    }

    $conn->close();
}
?>
