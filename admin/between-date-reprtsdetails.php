<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tblcourse where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage-course.php'</script>";     


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning|| Dashboard</title>
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


                    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                       <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$classid=$_POST['classid'];
  ?>
  <h5 align="center" style="color:blue">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
                        
                    </div>
                    <div class="table-responsive">

                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Course Title</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
$sql="SELECT tblclass.ID as cid,tblclass.Class,tblsubject.ID as sid,tblsubject.Subject,tblsubject.CreationDate,tblcourse.ID as courseid,tblcourse.CourseTitle,tblcourse.CreationDate as coursecd from tblcourse join tblclass on tblclass.ID=tblcourse.Class join tblsubject on tblsubject.ID=tblcourse.Subject where date(tblcourse.CreationDate) between '$fdate' and '$tdate' and tblclass.ID='$classid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php  echo htmlentities($row->Class);?></td>
                                    <td><?php  echo htmlentities($row->Subject);?></td>
                                    <td><?php  echo htmlentities($row->CourseTitle);?></td>
                                    <td><?php  echo htmlentities($row->coursecd);?></td>
                                   
                                    <td><a class="btn btn-sm btn-primary" href="edit-course.php?editid=<?php echo htmlentities ($row->courseid);?>">Edit</a> <a class="btn btn-sm btn-primary" href="manage-course.php?delid=<?php echo ($row->courseid);?>"  onclick="return confirm('Do you really want to Delete ?');">Delete</a></td>
                                </tr><?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against between this date</td>

  </tr>
  <?php } ?>
                               
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