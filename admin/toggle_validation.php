<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['email'])) {
        $email = $_GET['email'];

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
        $sql = "SELECT validation FROM tbluser WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $currentValidation = $row['validation'];

            // Toggle the 'validation' column value (0 to 1 or 1 to 0)
            $newValidation = ($currentValidation == 0) ? 1 : 0;

            // Update the 'validation' column with the new value
            $updateSql = "UPDATE tbluser SET validation = $newValidation WHERE Email = '$email'";
            if ($conn->query($updateSql) === TRUE) {
                header('location:reg-users.php'); // Redirect back to the previous page
            } else {
                echo "Error updating validation: " . $conn->error;
            }
        }

        $conn->close();
    }
}
?>
