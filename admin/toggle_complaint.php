<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Connect to your database (replace with your actual database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ocmmsdb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch the current value of the 'validation' column
        $sql = "SELECT status FROM tblquery WHERE sr_no = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $currentValidation = $row['status'];

            // Toggle the 'validation' column value (0 to 1 or 1 to 0)
            $newValidation = ($currentValidation == 0) ? 1 : 0;

            // Update the 'validation' column with the new value
            $updateSql = "UPDATE tblquery SET status = $newValidation WHERE sr_no = '$id'";
            
            if ($conn->query($updateSql) === TRUE) {
                
                header('location:view-complaint.php'); // Redirect back to the previous page
            } else {
                echo "Error updating status: " . $conn->error;
            }
        }

        $conn->close();
    }
}
?>
