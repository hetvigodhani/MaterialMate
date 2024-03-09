<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasaid'] == 0)) {
    header('location:logout.php');
} else {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ocmmsdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning|| Registered Users</title>
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid position-relative bg-white d-flex p-0">

            <?php include_once('includes/sidebar.php'); ?>
            <!-- Content Start -->
            <div class="content">
                <?php include_once('includes/header.php'); ?>

                <!-- Table code -->
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Class Name</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">Total Fees</th>
                                <th scope="col">Fees Paid</th>
                                <th scope="col">Pending Fees</th>
                                <th scope="col">Update Fees</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $sql = "SELECT u.ID,u.FullName,u.Email,c.Class,u.RegDate,c.Class_fee,u.Paid_fee from tbluser u LEFT join tblclass c on u.ClassID=c.ID;
                            ";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                $count = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $studentId = $row['ID'];
                                    $updateLink = "edit-fee-stu.php?id=$studentId";
                                    echo '<tr>';
                                    echo '<td>' . $count . '</td>';
                                    echo '<td>' . $row["FullName"] . '</td>';
                                    echo '<td>' . $row["Class"] . '</td>';
                                    echo '<td>' . $row["RegDate"] . '</td>';
                                    echo '<td>' . $row["Class_fee"] . '</td>';
                                    echo '<td>' . $row["Paid_fee"] . '</td>';
                                    echo '<td>' . $row["Class_fee"]-$row["Paid_fee"] . '</td>';
                                    // echo '<td>' . ($row["validation"] == 1 ? 'Granted' : 'Not Granted') . '</td>';
            
                                    echo '<td><a class="btn btn-sm btn-primary"
                                    href="edit-fee-stu.php?id=' . $row['ID'] . '&standard=' . $row['Class'] . '">Update</a></td>';
                                    echo '<td><input type="submit" name="submit" value="Send"></td>';
                                    echo '</tr>';
                                    $count++;
                                }
                            } else {
                                echo '<tr><td colspan="7">No records found!</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


                <!-- JavaScript Libraries -->
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                <script src="lib/chart/chart.min.js"></script>
                <script src="lib/easing/easing.min.js"></script>
                <script src="lib/waypoints/waypoints.min.js"></script>
                <script src="lib/owlcarousel/owl.carousel.min.js"></script>
                <script src="lib/tempusdominus/js/moment.min.js"></script>
                <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
                <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

                <!-- Template Javascript -->
                <script src="js/main.js"></script>
    </body>

    </html>
<?php } ?>