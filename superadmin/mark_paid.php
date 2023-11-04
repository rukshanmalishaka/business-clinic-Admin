<?php
// update_payment_status.php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: ../admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["booking_reference_code"])) {
        // Get the booking reference code from the form submission
        $booking_reference_code = $_POST["booking_reference_code"];

        require_once 'config.php';

        // SQL query to update the payment status to 'Paid' where the booking reference code matches
        $sql = "UPDATE booking_table SET payment_status = 'Paid' WHERE booking_reference_code = '$booking_reference_code'";

        if ($conn->query($sql) === TRUE) {
            // Payment status updated successfully
            header("Location: show_bookings.php");
            exit;
        } else {
            // Error updating payment status
            echo "Error updating payment status: " . $conn->error;
        }

        $conn->close();
    }
}
?>
