<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid'] == 0)) {
    header('location:logout.php');
} else {
    ?>

    <?php
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $sql = "SELECT u.FullName, q.stu_sub, q.stu_query, q.stu_querypic, q.status 
                FROM tblquery q
                INNER JOIN tbluser u ON q.stu_id = u.ID
                WHERE stu_class='$ocasucid' AND (u.FullName LIKE :search OR q.stu_sub LIKE :search)
                ORDER BY q.sr_no DESC;";
        $query = $dbh->prepare($sql);
        $query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    } else {
        $sql = "SELECT u.FullName, q.stu_sub, q.stu_query, q.stu_querypic, q.status 
                FROM tblquery q
                INNER JOIN tbluser u ON q.stu_id = u.ID
                WHERE stu_class='$ocasucid'
                ORDER BY q.sr_no DESC;";
        $query = $dbh->prepare($sql);
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>E-Learning || View Complaint</title>
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

            <?php include_once('includes/sidebar.php'); ?>
            <!-- Content Start -->
            <div class="content">
                <?php include_once('includes/header.php'); ?>


                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">View Complaint</h6>

                        </div>

                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">View Complaint</h6>
                                <form method="POST" action="">
                                    <input type="text" name="search" placeholder="Search">
                                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th scope="col">#</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Query</th>
                                            <th scope="col">Query Pic</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $ocasucid = $_SESSION['ocasucid'];

                                            // $sql = "SELECT u.FullName, s.Subject, q.stu_query, q.stu_querypic, q.status 
                                            // from tblquery q inner join tblsubject s on q.stu_sub=s.ClassID 
                                            // inner join tbluser u on q.stu_id=u.ID, tbluser
                                            // where stu_class='$ocasucid';";
                                        
                                            // $sql="SELECT u.FullName, q.stu_sub, q.stu_query, q.stu_querypic, q.status 
                                            // from tblquery q inner join tbluser u on q.stu_id=u.ID
                                            // where stu_class='$ocasucid' order by q.sr_no desc;";
                                        
                                            // $sql = "SELECT u.FullName, q.stu_sub, q.stu_query, q.stu_querypic, q.status , s.subject 
                                            // from tblquery q join tbluser u on q.stu_id=u.ID join tblsubject s 
                                            // on s.classid=u.classid where stu_class=18 order by q.sr_no desc;";

                                            $sql = "SELECT u.FullName, s.Subject, q.stu_query, q.stu_querypic, q.status 
                                            from tblquery q left join tbluser u on q.stu_id=u.ID 
                                            left join tblsubject s on q.stu_class=s.ID
                                            where stu_class='$ocasucid' order by q.sr_no desc;";
                                            //  where order by q.sr_no desc;";

                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) { ?>
                                                    <td>
                                                        <?php echo htmlentities($cnt); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row->FullName); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row->Subject); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo htmlentities($row->stu_query); ?>
                                                    </td>
                                                    <td>
                                                        <img src="folder1/<?php echo htmlentities($row->stu_querypic); ?>"
                                                            height="200px" width="200px">
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($row->status == 1) {
                                                            echo '<span style="color: green;">Solved</span>';
                                                        } else {
                                                            echo '<span style="color: red;">Not Solved</span>';
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                                }
                                            }

                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <?php include_once('includes/footer.php'); ?>
                </div>
                <!-- Content End -->
                <?php include_once('includes/back-totop.php'); ?>
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

    </html <?php } ?>