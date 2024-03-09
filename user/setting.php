<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable

error_reporting(0);
if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $uid = $_SESSION['ocasuid'];
        $cpassword = md5($_POST['currentpassword']);
        $newpassword = md5($_POST['newpassword']);
        $sql = "SELECT ID FROM tbluser WHERE ID=:uid and Password=:cpassword";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "update tbluser set Password=:newpassword where ID=:uid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':uid', $uid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();

            $message = "Your password successully changed";
            $messageClass = 'alert alert-success';
        } else {
            $message = "Your current password is wrong";
            $messageClass = 'alert alert-danger';

        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || Profile</title>

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
        <script type="text/javascript">
            function checkpass() {
                if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                    $message="New Password and Confirm Password Field do not match  !!";
                $messageClass = 'alert alert-danger';
                document.changepassword.confirmpassword.focus();
                    return false;
                }
                return true;
            }

        </script>
    </head>

    <body>
        <div class="container-fluid position-relative bg-white d-flex p-0">

            <?php include_once('includes/sidebar.php'); ?>


            <!-- Content Start -->
            <div class="content">
                <?php include_once('includes/header.php'); ?>


                <!-- Form Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Change Password</h6>
                                <?php
                                if (!empty($message)) {
                                    echo "<div class='$messageClass'>$message</div>";
                                }
                                ?>
                                <form method="post" name="changepassword" onsubmit="return checkpass();">

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="currentpassword"
                                            id="currentpassword" required='true'>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="newpassword" class="form-control"
                                            required="true">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirmpassword"
                                            id="confirmpassword" required='true'>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Change</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form End -->


                <?php include_once('includes/footer.php'); ?>
            </div>
            <!-- Content End -->


            <?php include_once('includes/back-totop.php'); ?>
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
<?php } ?>