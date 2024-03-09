<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        try {
            $ocasaid = $_SESSION['ocasuid'];
            $fee = $_POST['fee'];

            $sql = "update tbluser set Paid_fee=:fee where ID=:ocasaid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':ocasaid', $ocasaid, PDO::PARAM_STR);
            $query->bindParam(':fee', $fee, PDO::PARAM_STR);
            $query->execute();
            echo '<script>alert("Fees has been Updated.")</script>';
            echo "<script>window.location.href ='edit-fee.php'</script>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || Edit Fee</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="../admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../admin/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-fluid position-relative bg-white d-flex p-0">

            <?php include_once('includes/sidebar.php'); ?>
            <!-- Content Start -->
            <div class="content">
                <?php include_once('includes/header.php'); ?>


                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Edit Fee</h6>
                            <div class="table-responsive">
                                <form method="post">
                                    <label for="exampleInputEmail1" class="form-label">Paid Fee</label>
                                    <input type="number" class="form-control" name="fee" value="" required='true'><br>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <?php include_once('includes/footer.php'); ?>
        </div>
        <!-- Content End -->
        <?php include_once('includes/back-totop.php'); ?>

        <script src="../admin/https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="../admin/https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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

    </html <?php } ?>