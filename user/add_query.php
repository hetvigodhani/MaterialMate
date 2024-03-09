<?php
session_start();
include('includes/dbconnection.php');

$message = ' '; // Initialize the message variable
$messageClass = ' '; // Initialize the messageClass variable

if (empty($_SESSION['ocasuid'])) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $ocasaid = $_SESSION['ocasuid'];
        $studentName = $_POST['studentName'];
        $class = $_POST['class'];
        $subject = $_POST['subject'];
        $studentEmail = $_POST['studentEmail'];
        $queryDescription = $_POST['queryDescription'];

        // Check if a file is uploaded
        if (!empty($_FILES["queryPicture"]["name"])) {
            $queryPicture = $_FILES["queryPicture"]["name"];
            $extension1 = substr($queryPicture, -4);

            $allowed_extensions = array(".jpg", ".jpeg");

            if (!in_array($extension1, $allowed_extensions)) {
                $message = 'File has Invalid format. Only jpg / jpeg format allowed';
                $messageClass = 'alert alert-danger';
            } else {
                $queryPicture = time() . $extension1;
                $uploadPath = "folder1/" . $queryPicture;

                if (move_uploaded_file($_FILES["queryPicture"]["tmp_name"], $uploadPath)) {
                    $sql = "INSERT INTO tblquery(stu_id, stu_class, stu_sub, stu_email, stu_query, stu_querypic) VALUES (:ocasaid, :class, :subject, :studentEmail, :queryDescription, :queryPicture)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':ocasaid', $ocasaid, PDO::PARAM_STR);
                    $query->bindParam(':class', $class, PDO::PARAM_STR);
                    $query->bindParam(':subject', $subject, PDO::PARAM_STR);
                    $query->bindParam(':studentEmail', $studentEmail, PDO::PARAM_STR);
                    $query->bindParam(':queryDescription', $queryDescription, PDO::PARAM_STR);
                    $query->bindParam(':queryPicture', $queryPicture, PDO::PARAM_STR);

                    $query->execute();

                    $LastInsertId = $dbh->lastInsertId();
                    if ($LastInsertId > 0) {
                        $message = "Query has been added.";
                        $messageClass = 'alert alert-success';
                    } else {
                        $message = "Something Went Wrong. Please try again";
                        $messageClass = 'alert alert-danger';
                    }
                } else {
                    $message = "Error uploading the file. Please try again.";
                    $messageClass = 'alert alert-danger';
                }
            }
        } else {
            $message = "Please choose a file to upload.";
            $messageClass = 'alert alert-danger';
        }
    }
    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || Add Query</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <!-- Custom CSS -->


        <link href="../admin/css/style.css" rel="stylesheet">
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

                <!-- Your Form Here -->
                <div class="container">
                    <h2>Add Query</h2>

                    <div>
                    <?php
                            if (!empty($message)) {
                                echo "<div class='$messageClass'>$message</div>";
                            }
                            ?>
                    </div>


                    <form action="add_query.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Student Name</label>
                            <?php
                            $ocasaid = $_SESSION['ocasuid'];
                            $sql = "select FullName,Email from tbluser where ID=:$ocasaid;";
                            $query->execute();
                            $result = $query->fetch(PDO::FETCH_ASSOC);
                            if ($result) {
                                $fullName = $result['FullName'];
                                $email = $result['Email'];
                            }
                            ?>
                            
                            <input type="text" class="form-control" id="studentName" name="studentName"
                                value="<?php echo $fullName; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="studentStandard" class="form-label">Student Standard</label>
                            <select class="form-control" name="class" id="class" onChange="getSubject(this.value);">
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
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select name="subject" id="subject" class="form-control">
                                <option value="">Select</option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="studentEmail" class="form-label">Student Email</label>
                            <input type="email" class="form-control" id="studentEmail" name="studentEmail"
                                value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="queryDescription" class="form-label">Query Description</label>
                            <textarea class="form-control" id="queryDescription" name="queryDescription" rows="4"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="queryPicture" class="form-label">Query Picture</label>
                            <input type="file" class="form-control" id="queryPicture" name="queryPicture">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
                <!-- End of Your Form -->

                <?php include_once('includes/footer.php'); ?>
            </div>
            <!-- Content End -->

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
        </div>
    </body>

    </html>
<?php } ?>