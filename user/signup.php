<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable

if(isset($_POST['submit']))
  {
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $cid=$_POST['cid'];
    $password=md5($_POST['password']);
    $ret="select Email,MobileNumber from tbluser where Email=:email || MobileNumber=:mobno";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
    
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{
$sql="insert into tbluser(FullName,MobileNumber,Email,ClassID,Password)Values(:fname,:mobno,:email,:cid,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
$query->bindParam(':cid',$cid,PDO::PARAM_INT);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    $message = 'You have successfully registered with us';
    $messageClass = 'alert alert-danger';

}
else
{

echo "<script>alert('Something went wrong.Please try again');</script>";
}
}
 else
{

echo "<script>alert('Email-id or Mobile Number is already exist. Please try again');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>E-Learning || Signup</title>
   

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/../admin/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin/lib/tempusdominus/../admin/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><img src="../images/icon/logo.png" height="60px" width="170px"> </h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form method="post">
                        <div class="form-floating mb-3">
                            <input type="text" value="" name="fname" required="true" class="form-control">
                            <label for="floatingInput">Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                            <label for="floatingPassword">Mobile Number</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" value="" name="email" required="true">
                            <label for="floatingPassword">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select type="text" value="" name="cid" required="true" class="form-control">
                                        <option value="">Select Class</option>
                                        <?php
                                          
$sql="SELECT * from tblclass";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{            


   ?>
                                       <option value="<?php  echo $row->ID;?>"><?php  echo htmlentities($row->Class);?></option><?php $cnt=$cnt+1;}} ?>
                                    </select>
                            
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" value="" class="form-control" name="password" required="true">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                           
                            <a href="signin.php">Already Registered !!</a>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Sign Up</button>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
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

</html>