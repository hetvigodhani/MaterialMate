<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable

if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $ocasaid = $_SESSION['ocasaid'];
        $class = $_POST['class'];
        $eid = $_GET['editid'];
        $sql = "UPDATE tblclass SET Class=:class WHERE ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':class', $class, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            // Set success message and class
            $message = 'Class has been added.';
            $messageClass = 'alert alert-success';
        } else {
            // Set error message and class
            $message = 'Something Went Wrong. Please try again';
            $messageClass = 'alert alert-danger';
        }
    } 

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning|| Update Class</title>
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

                <!-- Form Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Update Class</h6>
                                <?php
                            if (!empty($message)) {
                                echo "<div class='$messageClass'>$message</div>";
                            }
                            ?>
                                <form method="post">
                                    <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT * FROM tblclass WHERE ID=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            ?>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Class</label>
                                                <input type="text" class="form-control" name="class"
                                                    value="<?php echo htmlentities($row->Class); ?>" required='true'>
                                            </div>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form End -->

                <?php include_once('includes/footer.php'); ?>
            </div>
            <!-- Content End -->

            <?php include_once('includes/back-totop.php'); ?>
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