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
    $sql = "UPDATE consultant_registration SET status='approved' WHERE id='$consultant_id'";
    if ($conn->query($sql) === TRUE) {
        // Retrieve consultant details for email notification
        $query = "SELECT * FROM consultant_registration WHERE id='$consultant_id'";
        $result = $conn->query($query);
        if ($result->num_rows === 1) {
            $consultant = $result->fetch_assoc();
            $consultant_email = $consultant['email'];

            // Generate a random password for the consultant
            $autoGeneratedPassword = bin2hex(random_bytes(4)); // You can use any secure method to generate a password

            // Hash the password before storing it in the database (Recommended)
            $hashedPassword = password_hash($autoGeneratedPassword, PASSWORD_DEFAULT);

            // Create a user record in the consult_users table
            $insertUserSql = "UPDATE consultant_registration SET password = '$hashedPassword' WHERE id='$consultant_id'";
            
            
            
            if ($conn->query($insertUserSql) === TRUE) {
                
                $htmlContent = file_get_contents("email-templates/approve_email.php");
                
                // Replace placeholders in the HTML content with actual data
                $htmlContent = str_replace(
                    array("{FIRST_NAME}", "{EMAIL}", "{PASSWORD}"),
                    array($consultant['first_name'], $consultant_email, $autoGeneratedPassword),
                $htmlContent);
                
                // Send email to the approved consultant with login details
                $to = $consultant_email;
                $subject = "Your Consultant Account has been Approved";
               
               $headers = "From: rukshan@refectline.com\r\n"; // Set the admin's email address here
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                // Send the email
                if (mail($to, $subject, $htmlContent, $headers)) {
                    echo "Approval email sent to the consultant.";
                } else {
                    echo "Error sending approval email.";
                }
            } else {
                echo "Error creating user account for the consultant.";
            }
        } else {
            echo "Consultant not found.";
        }

        // Redirect back to the pending_consultants.php page after approval
        header("Location: pending_consultants.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
