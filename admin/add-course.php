<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable

if (strlen($_SESSION['ocasaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        $ocasaid = $_SESSION['ocasaid'];
        $class = $_POST['class'];
        $subject = $_POST['subject'];
        $coursetitle = $_POST['coursetitle'];
        $coursedesc = $_POST['coursedesc'];
        $file1 = $_FILES["file1"]["name"];
        $maxFileSize = 30 * 1024 * 1024;


        $extension1 = substr($file1, strlen($file1) - 4, strlen($file1));
        $file2 = $_FILES["file2"]["name"];
        $extension2 = substr($file2, strlen($file2) - 4, strlen($file2));
        $file3 = $_FILES["file3"]["name"];
        $extension3 = substr($file3, strlen($file3) - 4, strlen($file3));
        $file4 = $_FILES["file4"]["name"];
        $extension4 = substr($file4, strlen($file4) - 4, strlen($file4));
        $allowed_extensions = array("docs", ".doc", ".pdf");

        if (!in_array($extension1, $allowed_extensions)) {
            echo "<script>alert('File has Invalid format. Only docs / doc / pdf format allowed');</script>";
            //$messageClass = 'alert alert-danger';
        }
        
        // if (!in_array($extension2, $allowed_extensions)) {
        //     $message = 'File has Invalid format. Only docs / doc / pdf format allowed';
        //     $messageClass = 'alert alert-danger';
        // }

        // if (!in_array($extension3, $allowed_extensions)) {
        //     $message = 'File has Invalid format. Only docs / doc / pdf format allowed';
        //     $messageClass = 'alert alert-danger';
        // }

        // if (!in_array($extension4, $allowed_extensions)) {
        //     $message = 'File has Invalid format. Only docs / doc / pdf format allowed';
        //     $messageClass = 'alert alert-danger';
        // }
        else {
            if ($_FILES["file1"]["size"] > 1000000 ) {
                $message = "File size should not be above 1MB.";
                $messageClass = 'alert alert-danger';
                // echo "<script>alert('File size should not be above 1MB.');</script>";
                // echo '<script>$messageClass='alert alert-danger'</script>';
            } 
            if ($_FILES["file1"]["size"] < 1000000 ){
                $file1 = md5($file1) . time() . $extension1;
                if ($file2 != '') {
                    $file2 = md5($file2) . time() . $extension2;
                }
                if ($file3 != '') {
                    $file3 = md5($file3) . time() . $extension3;
                }
                if ($file4 != '') {
                    $file4 = md5($file4) . time() . $extension4;
                }

                move_uploaded_file($_FILES["file1"]["tmp_name"], "folder1/" . $file1);
                move_uploaded_file($_FILES["file2"]["tmp_name"], "folder2/" . $file2);
                move_uploaded_file($_FILES["file3"]["tmp_name"], "folder3/" . $file3);
                move_uploaded_file($_FILES["file4"]["tmp_name"], "folder4/" . $file4);

                $sql = "INSERT INTO tblcourse(Class,Subject,CourseTitle,CourseDecription,File1,File2,File3,File4) VALUES(:class,:subject,:coursetitle,:coursedesc,:file1,:file2,:file3,:file4)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':class', $class, PDO::PARAM_STR);
                $query->bindParam(':subject', $subject, PDO::PARAM_STR);
                $query->bindParam(':coursetitle', $coursetitle, PDO::PARAM_STR);
                $query->bindParam(':coursedesc', $coursedesc, PDO::PARAM_STR);
                $query->bindParam(':file1', $file1, PDO::PARAM_STR);
                $query->bindParam(':file2', $file2, PDO::PARAM_STR);
                $query->bindParam(':file3', $file3, PDO::PARAM_STR);
                $query->bindParam(':file4', $file4, PDO::PARAM_STR);

                $query->execute();

                $LastInsertId = $dbh->lastInsertId();
                if ($LastInsertId > 0) {
                    // echo "<script>alert('Chapters has been added');</script>";
                    $message = "Chapters has been added.";
                    $messageClass = 'alert alert-success';
                } else {
                    // echo "<script>alert('Something Went Wrong. Please try again');</script>";
                    $message = "Something Went Wrong. Please try again";
                    $messageClass = 'alert alert-danger';
                }
            }
            // else
            // {
            //     echo "<script>alert('File size should not be above 50MB.');</script>";
            // }

        }

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || Add Chapter</title>

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
        <script>
            function getSubject(val) {
                //alert(val);
                $.ajax({
                    type: "POST",
                    url: "get-subject.php",
                    data: 'subid=' + val,
                    success: function (data) {
                        $("#subject").html(data);
                    }
                });
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
                                <h6 class="mb-4">Add Chapter</h6>
                                <form method="post" enctype="multipart/form-data">
                                    <?php 
                                    if (!empty($message)) {
                                        echo "<div class='$messageClass'>$message</div>";
                                    }
                                    
                                     ?>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Class</label>
                                        <select class="form-control" name="class" id="class"
                                            onChange="getSubject(this.value);">
                                            <option value="">Choose Class</option>
                                            <?php
                                            $sql = "SELECT * from tblclass";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <option value="<?php echo $row->ID; ?>">
                                                        <?php echo $row->Class; ?>
                                                    </option>
                                                    <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </select>
                                    </div>

                                    <br />
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Subject</label>
                                        <select name="subject" id="subject" class="form-control">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Chapter Title</label>
                                        <input type="text" class="form-control" name="coursetitle" value="" required='true'>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Chapter Description</label>
                                        <textarea class="form-control" name="coursedesc" value=""
                                            required='true'></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Upload Material</label>
                                        <input type="file" class="form-control" name="file1" value="" required='true'>

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Upload Material</label>
                                        <input type="file" class="form-control" name="file2" value="">

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Upload Material</label>
                                        <input type="file" class="form-control" name="file3" value="">

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">Upload Material</label>
                                        <input type="file" class="form-control" name="file4" value="">

                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
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

    </html>
<?php } ?>