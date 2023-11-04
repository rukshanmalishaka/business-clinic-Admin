<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['consultant_id'])) {

   require_once 'config.php';

    $consultant_id = $_POST['consultant_id'];

    // Update the consultant status to "approved"
    $sql = "UPDATE consultant_registration SET status='rejected' WHERE id='$consultant_id'";
    if ($conn->query($sql) === TRUE) {
        // Retrieve consultant details for email notification
        $query = "SELECT * FROM consultant_registration WHERE id='$consultant_id'";
        $result = $conn->query($query);
        if ($result->num_rows === 1) {
            $consultant = $result->fetch_assoc();
            $consultant_email = $consultant['email'];


            // Create a user record in the consult_users table
           
   
                $htmlContent = file_get_contents("superadmin/email-templates/reject_email.php");
                
                // Replace placeholders in the HTML content with actual data
                $htmlContent = str_replace(
                    array("{FIRST_NAME}"),
                    array($consultant['first_name']),
                $htmlContent);
                
   
                // Send email to the approved consultant with login details
                $to = $consultant_email;
                $subject = "Your consultant account has been Rejected";
              
                $headers = "From: rukshan@refectline.com\r\n"; // Set the admin's email address here
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                // Send the email
                if (mail($to, $subject, $htmlContent, $headers)) {
                    echo "Reject email sent to the consultant.";
                } else {
                    echo "Error sending Reject email.";
                }
           
        } else {
            echo "Consultant not found.";
        }

        // Redirect back to the pending_consultants.php page after approval
        header("Location: all_consultants.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
