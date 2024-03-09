<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><img src="..\images\icon\favicon.png" height="40px"></i>E-Learning</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <?php
                $aid = $_SESSION['ocasaid'];
                $sql = "SELECT * from  tbladmin where ID=:aid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                        <h6 class="mb-0">
                            <?php echo $row->AdminName; ?>
                        </h6>
                        <!-- <span><?php echo $row->Email; ?></span><?php $cnt = $cnt + 1;
                    }
                } ?> -->
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="dashboard.php" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-user me-2"></i>Admin</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="add-admin.php" class="dropdown-item">Add Admin</a>
                    <a href="manage-admin.php" class="dropdown-item">Manage Admin</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Class</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="add-class.php" class="dropdown-item">Add Class</a>
                    <a href="manage-class.php" class="dropdown-item">Manage Class</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Subject</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="add-subject.php" class="dropdown-item">Add Subject</a>
                    <a href="manage-subject.php" class="dropdown-item">Manage Subject</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-keyboard me-2"></i>Chapters</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="add-course.php" class="dropdown-item">Add Chapter</a>
                    <a href="manage-course.php" class="dropdown-item">Manage Chapter</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Fees</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="edit-fee.php" class="dropdown-item">Change Fees</a>
                    <a href="list-fee.php" class="dropdown-item">View Fee Status</a>
                </div>
            </div>
            <a href="reg-users.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Reg Users</a>
            <a href="view-complaint.php" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Complaint</a>


            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Reports</a>
                <div class="dropdown-menu bg-transparent border-0">

                    <a href="classwise-bwdates-reports.php" class="dropdown-item">b/w dates Report</a>

                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->