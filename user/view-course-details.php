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
    <title>E-Learning  || View Course</title>
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


                    <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Download Files</h6>
                        
                    </div>
                    <div class="table-responsive">
                        <?php
                                    $vid=$_GET['viewid'];
$sql="SELECT tblclass.ID as cid,tblclass.Class as classname,tblsubject.ID as sid,tblsubject.Subject as subjectname,tblsubject.CreationDate,tblcourse.ID as courseid,tblcourse.CourseTitle,tblcourse.Class,tblcourse.Subject,tblcourse.CourseDecription,tblcourse.File1,tblcourse.File2,tblcourse.File3,tblcourse.File4,tblcourse.CreationDate as coursecd from tblcourse join tblclass on tblclass.ID=tblcourse.Class join tblsubject on tblsubject.ID=tblcourse.Subject where tblcourse.ID=:vid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':vid', $vid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                           
                                <tr>
  <th width="200"><strong>Class Name</strong></th>
  <td><?php  echo htmlentities($row->classname);?></td>
  <th><strong>Subject Name</strong></th>
  <td><?php  echo htmlentities($row->subjectname);?></td>
  </tr>
  <tr>
  <th width="200"><strong>Course Title</strong></th>
  <td><?php  echo htmlentities($row->CourseTitle);?></td>
  <th><strong>Course Description</strong></th>
  <td><?php  echo htmlentities($row->CourseDecription);?></td>
  </tr>
  
  <tr>
  <th width="200"><strong>File 1</strong></th>
  <td colspan="3" style="text-align: center;"><a href="../admin/folder1/<?php echo $row->File1;?>" width="100" height="100" target="_blank"> <strong style="color: red">Download File</strong></a></td>
  
  </tr>
  <?php if($row->File2==""){ ?>
    <tr>
  <th width="200"><strong>File 2</strong></th>
  <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>
  
  </tr><?php } else{?>
  <tr>
  <th width="200"><strong>File 2</strong></th>
  <td colspan="3" style="text-align: center;"><a href="../admin/folder2/<?php echo $row->File2;?>" width="100" height="100" target="_blank"> <strong style="color: red">Download File</strong></a></td>
  
  </tr> <?php } ?>
  <?php if($row->File3==""){ ?>
    <tr>
  <th width="200"><strong>File 3</strong></th>
  <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>
  
  </tr><?php } else{?>
  <tr>
  <th width="200"><strong>File 3</strong></th>
  <td colspan="3" style="text-align: center;"><a href="../admin/folder3/<?php echo $row->File3;?>" width="100" height="100" target="_blank"> <strong style="color: red">Download File</strong></a></td>
  
  </tr><?php } ?>
  <?php if($row->File4==""){ ?>
    <tr>
  <th width="200"><strong>File 3</strong></th>
  <td colspan="3" style="text-align: center;"><strong style="color: red">File is not available</strong></td>
  
  </tr><?php } else{?>
  <tr>
  <th width="200"><strong>File 4</strong></th>
  <td colspan="3" style="text-align: center;"><a href="../admin/folder4/<?php echo $row->File4;?>" width="100" height="100" target="_blank"> <strong style="color: red">Download File</strong></a></td>
  
  </tr><?php } ?>
  <?php $cnt=$cnt+1;}} ?>
                               
                            
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

</html><?php }  ?>