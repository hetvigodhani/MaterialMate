<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['subjectid'])) {
        $subjectid = intval($_GET['subjectid']);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>E-Learning  || View Uploaded Chapters</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
            
            <!-- Icon Font Stylesheet -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

            <!-- Customized Bootstrap Stylesheet -->
            <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

            <!-- Template Stylesheet -->
            <link href="../admin/css/style.css" rel="stylesheet">
        </head>

        <body>
            <div class="container-fluid position-relative bg-white d-flex p-0">
                <?php include_once('includes/sidebar.php');?>
                <!-- Content Start -->
                <div class="content">
                    <?php include_once('includes/header.php');?>

                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">View Uploaded Chapters</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">#</th>
                                            <th scope="col">Chapter Name</th>
                                            <th scope="col">Chapter Description</th>
                                            <th scope="col">Action</th> <!-- Add this column for the view button -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT `CourseTitle`, `CourseDecription`, `ID` FROM tblcourse WHERE Subject = :subjectid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':subjectid', $subjectid, PDO::PARAM_INT);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($row->{'CourseTitle'});?></td>
                                                    <td><?php echo htmlentities($row->CourseDecription);?></td>
                                                    <td>
                                                        <!-- Add view button with course ID in the URL -->
                                                        <a class="btn btn-sm btn-primary" href="view-chapter-details.php?courseid=<?php echo htmlentities($row->ID);?>">View</a>
                                                    </td>
                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">No chapters found for this subject.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php include_once('includes/footer.php');?>
                </div>
                <!-- Content End -->
                <?php include_once('includes/back-totop.php');?>
            </div>

            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../admin/lib/chart/chart.min.js"></script>
            <script src="../admin/lib/easing/easing.min.js"></script>
            <script src="../admin/lib/waypoints/waypoints.min.js"></script>
            <script src="../admin/lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="../admin/lib/tempusdominus/js/moment.min.js"></script>
            <script src="../admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="../admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

            <!-- Template Javascript -->
            <script src="../admin/js/main.js"></script>
        </body>
        </html>
    <?php
    } else {
        header('location:logout.php');
    }
}
?>
