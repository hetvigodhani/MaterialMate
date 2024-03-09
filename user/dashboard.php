<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning || Dashboard</title>
    <!-- Google Web Fonts -->
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
        
        <?php include_once('includes/sidebar.php');?>
        <!-- Content Start -->
        <div class="content">
            <?php include_once('includes/header.php');?>


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <?php
$uid=$_SESSION['ocasuid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <h1>Hello, <?php  echo $row->FullName;?> <span>  Welcome to your panel</span></h1><?php $cnt=$cnt+1;}} ?>
                        
                    </div>
                    
                </div>
            </div>
            <!-- Recent Sales End -->
<div class="container-fluid pt-4 px-4">
                <div class="row g-8">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <?php 
                        $stdcid=$_SESSION['ocasucid'];
$sql1 ="SELECT tblclass.ID as cid,tblclass.Class,tblsubject.ID as sid,tblsubject.Subject,tblsubject.CreationDate,tblcourse.ID as courseid,tblcourse.CourseTitle,tblcourse.CreationDate as coursecd from tblcourse join tblclass on tblclass.ID=tblcourse.Class join tblsubject on tblsubject.ID=tblcourse.Subject join tbluser on tbluser.ClassID=tblclass.ID where tblclass.ID=:stdcid";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':stdcid', $stdcid, PDO::PARAM_STR);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totcourse=$query1->rowCount();
?>
                                <p class="mb-2">Total Course Material</p>
                                <h4 style="color: blue"><?php echo htmlentities($totcourse);?></h4>
                                        <a href="view-material.php"><h5>View Detail</h5></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php include_once('includes/footer.php');?>
        </div>
        <!-- Content End -->
<?php include_once('includes/back-totop.php');?>
    </div>

    <!-- JavaScript Libraries -->
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

</html><?php }  ?>