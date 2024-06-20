<?php
include 'config.php';  // Pastikan jalur ini benar, sesuaikan dengan struktur folder Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input data
    $NIM = $conn->real_escape_string($_POST['NIM']);
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $class = $conn->real_escape_string($_POST['class']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Insert data into database
    $sql = "INSERT INTO users (NIM, fullname, class, email, password) VALUES ('$NIM', '$fullname', '$class', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../signin.html");  // Mengarahkan pengguna ke halaman login setelah berhasil signup
        exit();  // Penting untuk menghentikan eksekusi setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi setelah semua operasi selesai
    $conn->close();
}
?>
