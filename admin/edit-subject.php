<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$message = ''; // Initialize an empty message variable
$messageClass = ' '; // Initialize the messageClass variable
if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $cid = $_POST['cid'];
        $subject = $_POST['subject'];
        $eid = $_GET['editid'];
        $sql = "UPDATE tblsubject SET ClassID=:cid, Subject=:subject WHERE ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        // Check if update was successful
        if ($query->rowCount() > 0) {
            $message = 'Subject has been updated.';
            $messageClass = 'alert alert-success';
        } else {
            $message = 'Failed to update subject.';
            $messageClass = 'alert alert-danger';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning|| Update Subject</title>
  
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


            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Update Subject</h6>
                            <?php
                            if (!empty($message)) {
                                echo "<div class='$messageClass'>$message</div>";
                            }
                            ?>
                            <form method="post">
                                <?php
                                $eid=$_GET['editid'];
$sql="SELECT tblclass.ID as cid,tblclass.Class,tblsubject.ID as sid,tblsubject.Subject,tblsubject.CreationDate,tblsubject.ClassID from tblsubject join tblclass on tblclass.ID=tblsubject.ClassID where tblsubject.ID =:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Class</label>
                                    <select class="form-control" name="cid" >
            <option value="<?php  echo htmlentities($row->ClassID);?>"><?php  echo htmlentities($row->Class);?></option>
            <?php
$sql1="SELECT * from tblclass";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query1->rowCount() > 0)
{
foreach($results1 as $row1)
{               ?>
            <option value="<?php  echo htmlentities($row1->ID);?>"><?php  echo htmlentities($row1->Class);?></option><?php $cnt=$cnt+1;}} ?>
        </select>
                                   
                                </div>
<div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Subject</label>
                                    <input type="text" class="form-control"  name="subject" value="<?php  echo htmlentities($row->Subject);?>" required='true'>
                                </div>
                                <?php $cnt=$cnt+1;}} ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->


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