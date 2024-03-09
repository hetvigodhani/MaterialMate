<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || View Fee</title>
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
                            <h6 class="mb-0">View Fee</h6>

                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Registration Date</th>
                                        <th scope="col">Total Fee</th>
                                        <th scope="col">Paid Fee</th>
                                        <th scope="col">Pending Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $stdcid = $_SESSION['ocasuid'];
                                        $sql = "SELECT c.Class,u.RegDate,c.Class_fee,u.Paid_fee 
                                        from tbluser u left join tblclass c 
                                        on u.ClassID=c.ID 
                                        where u.ID=:stdcid;
                                        ";
                                
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':stdcid', $stdcid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <td>
                                                    <?php echo htmlentities($cnt); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Class); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->RegDate); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Class_fee); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Paid_fee); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlentities($row->Class_fee - $row->Paid_fee); ?>
                                                </td>
                                                
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                            }
                                        }
                                        
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <?php include_once('includes/footer.php'); ?>
            </div>
            <!-- Content End -->
            <?php include_once('includes/back-totop.php'); ?>
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

    </html <?php } ?>