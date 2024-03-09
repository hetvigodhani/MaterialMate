<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasaid']==0)) {
  header('location:logout.php');
  } else{

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-learning || Dashboard</title>
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
        
        <?php include_once('includes/sidebar.php');?>
        <!-- Content Start -->
        <div class="content">
            <?php include_once('includes/header.php');?>


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-book-open fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php
$sql1 ="SELECT * from tblcourse";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totcourse=$query1->rowCount();
?>
                                <p class="mb-2">Total Course</p>
                                <h4 style="color: blue"><?php echo htmlentities($totcourse);?></h4>
                                        <a href="manage-course.php"><h5>View Detail</h5></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-desktop fa-3x text-primary"></i>
                            <div class="ms-3">
                                 <?php
$sql2 ="SELECT * from tblclass";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totclass=$query2->rowCount();
?>
                                <p class="mb-2">Total Class</p>
                                <h4 style="color: blue"><?php echo htmlentities($totclass);?></h4>
                                        <a href="manage-class.php"><h5>View Detail</h5></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-file fa-3x text-primary"></i>
                            <div class="ms-3">
                                 <?php
$sql3 ="SELECT * from tblsubject";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totsub=$query3->rowCount();
?>
                                <p class="mb-2">Total Subject</p>
                                <h4 style="color: blue"><?php echo htmlentities($totsub);?></h4>
                                        <a href="manage-subject.php"><h5>View Detail</h5></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php
$sql4 ="SELECT * from tbluser";
$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$totreguser=$query4->rowCount();
?>
                                <p class="mb-2">Total Reg Users</p>
                                <h4 style="color: blue"><?php echo htmlentities($totreguser);?></h4>
                                        <a href="reg-users.php"><h5>View Detail</h5></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php //include_once('includes/footer.php');?>
        </div>
        <!-- Content End -->
<?php include_once('includes/back-totop.php');?>
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

</html><?php }  ?>