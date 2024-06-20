<?php
session_start();
include 'config.php';  // Pastikan jalur ini benar, sesuaikan dengan struktur folder Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT id_dosen, email, password FROM users_dosen WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {  
            $_SESSION['user_id'] = $row['id_dosen'];
            $_SESSION['email'] = $row['email'];
            header("Location: ../dashboard_dosen.html");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }

    $conn->close();
}
?>
