<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['login'])) {
    $emailormobnum = $_POST['emailormobnum'];
    $password = md5($_POST['password']);

    // Check if the user is validated (validation column = 1)
    $sql = "SELECT Email, MobileNumber, Password, ID, ClassID, validation FROM tbluser WHERE (Email=:emailormobnum || MobileNumber=:emailormobnum) AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailormobnum', $emailormobnum, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['ocasuid'] = $result->ID;
            $_SESSION['ocasucid'] = $result->ClassID;

            // Set session variables for standard, full name, and email
            $_SESSION['standard'] = $result->ClassID;
            $_SESSION['fullname'] = $result->FullName; // Assuming 'FullName' is the column name in your database
            $_SESSION['email'] = $result->Email;

            // Check if the user is validated (validation column = 1)
            if ($result->validation == 1) {
                $_SESSION['login'] = $_POST['emailormobnum'];
                $_SESSION['ocasucid'] = $result->ClassID;
                header('Location: dashboard.php');
            } else {
                $msg = "Admin has not granted you access to use this.";
            }
        }
    } else {
        $msg = "Invalid Details";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Learning || Signin</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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
       
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><img src="../images/icon/logo.png" height="60px" width="170px"></h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo '<div class="alert alert-danger">' . $msg . '</div>';
                        }
                        ?>
                        <br>
                        <form method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Email or Mobile Number" required="true" name="emailormobnum">
                            <label for="floatingInput">Email or Mobile Number</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="forgot-password.php">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="login">Sign In</button>
                        </form>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="../index.html">Home Page!!</a>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <a href="signup.php">Create an account!!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</html>
