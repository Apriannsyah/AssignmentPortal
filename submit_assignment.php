<?php
// Ensure file config.php includes the database connection
include 'php/config.php';

if (isset($_POST['submit'])) {
    $assignment_id = $_POST['assignment_id'];
    $NIM = $_POST['NIM']; // Assuming NIM is entered via a form input
    $submission_date = date('Y-m-d'); // Current date

    // Fetch student name based on NIM
    $sql_fetch_student = "SELECT fullname FROM users WHERE NIM = '$NIM'";
    $result = $conn->query($sql_fetch_student);

    if ($result->num_rows > 0) {
        // If student with provided NIM exists, fetch the student_name
        $row = $result->fetch_assoc();
        $student_name = $row['fullname'];

        // File upload handling
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo '<div class="alert alert-danger" role="alert">Sorry, file already exists.</div>';
            $uploadOk = 0;
        }

        // Check file size (500KB limit)
        if ($_FILES["file"]["size"] > 500000) {
            echo '<div class="alert alert-danger" role="alert">Sorry, your file is too large.</div>';
            $uploadOk = 0;
        }

        // Allow only certain file formats (PDF, DOC, DOCX)
        if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
            echo '<div class="alert alert-danger" role="alert">Sorry, only PDF, DOC & DOCX files are allowed.</div>';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<div class="alert alert-danger" role="alert">Sorry, your file was not uploaded.</div>';
        } else {
            // Upload file
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $file_location = $target_file;

                // Insert submission data into database
                $sql = "INSERT INTO submissions (assignment_id, NIM, student_name, submission_date, file_location) 
                        VALUES ('$assignment_id', '$NIM', '$student_name', '$submission_date', '$file_location')";

                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Submission berhasil disimpan.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
            }
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Student with provided NIM not found.</div>';
    }

    $conn->close(); // Close database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Assignment - Assignment Portal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="dashboard_dosen.html">Assignment Portal</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="assignment_list_mhs.php">Assignment List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="submit_assignment.php">Submit Assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signin.html">Sign Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Submit Assignment</h2>
        
        <form action="submit_assignment.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="assignment_id">Assignment ID</label>
                <input type="text" class="form-control" id="assignment_id" name="assignment_id" required>
            </div>
            <div class="form-group">
                <label for="NIM">NIM</label>
                <input type="text" class="form-control" id="NIM" name="NIM" required>
            </div>
            <div class="form-group">
                <label for="file">Upload File</label>
                <input type="file" class="form-control-file" id="file" name="file" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
