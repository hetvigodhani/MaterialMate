<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    $message = ''; // Initialize an empty message variable
    $messageClass = ' '; // Initialize the messageClass variable
    if (isset($_POST['submit'])) {
        $adminName = $_POST['adminName'];
        $userName = $_POST['userName'];
        $mobno = $_POST['mobno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        // Check if admin with the same email or mobile number already exists
        $checkAdmin = "SELECT Email, MobileNumber FROM tbladmin WHERE Email = :email OR MobileNumber = :mobno";
        $query = $dbh->prepare($checkAdmin);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            // Admin does not exist, proceed with registration
            $sql = "INSERT INTO tbladmin (AdminName, UserName, MobileNumber, Email, Password) VALUES (:adminName, :userName, :mobno, :email, :password)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':adminName', $adminName, PDO::PARAM_STR);
            $query->bindParam(':userName', $userName, PDO::PARAM_STR);
            $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);

            if ($query->execute()) {
                // Registration successful
                $message = 'Admin added successfully';
                $messageClass = 'alert alert-success';
            } else {
                $message = 'Something went wrong. Please try again';
                $messageClass = 'alert alert-danger';
            }
        } else {
            $message = 'Email or Mobile Number is already registered. Please try again';
            $messageClass = 'alert alert-danger';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning|| Add Admin</title>
  
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
           
         <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div>
                <?php
                            if (!empty($message)) {
                                echo "<div class='$messageClass'>$message</div>";
                            }
                            ?>
</div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="message">

         <form method="post">
                            <div class="form-floating mb-3">
                                <input type="text" value="" name="adminName" required="true" class="form-control">
                                <label for="floatingInput">Admin Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" value="" name="userName" required="true" class="form-control">
                                <label for="floatingInput">User Name</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" name="mobno" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                                <label for="floatingPassword">Mobile Number</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" value="" name="email" required="true">
                                <label for="floatingPassword">Email Address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" value="" class="form-control" name="password" required="true">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Add Admin</button>
                        </form>
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