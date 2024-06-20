<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment List - Assignment Portal</title>
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
                    <a class="nav-link" href="submit_assignment.php">Submit Assignment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="assignment_list_mhs.php">Assignment List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signin.html">Sign In</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Assignment List</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Assignment ID</th>
                        <th>Assignment Name</th>
                        <th>Subject Name</th>
                        <th>Deadline Date</th>
                        <th>Submission Location</th>
                        <th>Dosen ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'php/config.php'; 

                    
                    $sql = "SELECT * FROM assignments";
                    $result = $conn->query($sql);

                    
                    if ($result->num_rows > 0) {
                        $no = 1;
                        
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row["assignment_id"] . "</td>";
                            echo "<td>" . $row["assignment_name"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            echo "<td>" . $row["deadline_date"] . "</td>";
                            echo "<td>" . $row["submission_location"] . "</td>";
                            echo "<td>" . $row["dosen_id"] . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data yang ditemukan</td></tr>";
                    }

                    // Menutup koneksi ke database
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    

    <!-- Optional JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
