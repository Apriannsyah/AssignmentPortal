<?php
session_start();
include 'config.php';  // Pastikan jalur ini benar, sesuaikan dengan struktur folder Anda

if (!isset($_SESSION['user_id'])) {
    die("User ID tidak ditemukan. Silakan login kembali.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $assignment_name = $conn->real_escape_string($_POST['assignment_name']);
    $subject_name = $conn->real_escape_string($_POST['subject_name']);
    $created_date = $conn->real_escape_string($_POST['created_date']);
    $submission_location = $conn->real_escape_string($_POST['submission_location']);
    $dosen_id = $_SESSION['user_id'];  // Menggunakan ID dosen dari sesi

    // Query untuk memasukkan data tugas baru ke dalam database
    $sql = "INSERT INTO assignments (assignment_name, subject_name, created_date, submission_location, dosen_id) 
            VALUES ('$assignment_name', '$subject_name', '$created_date', '$submission_location', '$dosen_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../assignment_list.php");  // Mengarahkan pengguna ke halaman daftar tugas setelah berhasil menambah tugas
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
