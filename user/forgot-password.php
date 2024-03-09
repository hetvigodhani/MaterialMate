<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Email FROM tbluser WHERE Email=:email and MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $con = "update tbluser set Password=:newpassword where Email=:email and MobileNumber=:mobile";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
        $message = "Your Password succesfully changed";
        $messageClass = 'alert alert-success';
    } else {
        $message = "Email id or Mobile no is invalid";
        $messageClass = 'alert alert-danger';
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/../admin/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin/lib/tempusdominus/../admin/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style.css" rel="stylesheet">
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                $message="New Password and Confirm Password Field do not match  !!";
                $messageClass = 'alert alert-danger';
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                                <h3 class="text-primary"><img src="../images/icon/logo.png" height="60px" width="170px"></h3>
                            </a>
                            <h3>Reset Password</h3>
                        </div>
                        <?php
                            if (!empty($message)) {
                                echo "<div class='$messageClass'>$message</div>";
                            }
                            ?>
                        <form method="post" name="chngpwd" onSubmit="return valid();">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" placeholder="Email Address" required="true"
                                    name="email">
                                <label for="floatingInput">Email Address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Mobile Number" required="true"
                                    name="mobile" maxlength="10" pattern="[0-9]+">
                                <label for="floatingPassword">Mobile Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="newpassword" class="form-control"
                                    placeholder="New Password" required="true">
                                <label for="floatingInput">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="confirmpassword" class="form-control"
                                    placeholder="Confirm Password" required="true">
                                <label for="floatingInput">Confirm Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <label class="pull-right">
                                        <a href="signin.php">SignIn ?</a>
                                    </label>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Reset</button>

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