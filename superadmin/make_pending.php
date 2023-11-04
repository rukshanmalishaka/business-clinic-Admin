<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: ../admin_login.php");
    exit();
}

if (isset($_POST['consultant_id'])) {

   require_once 'config.php';

    $consultant_id = $_POST['consultant_id'];

    // Update the consultant status to "approved"
    $sql = "UPDATE consultant_registration SET status='pending' WHERE id='$consultant_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the rejected_consultants.php page after approval
        header("Location: rejected_consultants.php");
        exit;
            } 
          
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
