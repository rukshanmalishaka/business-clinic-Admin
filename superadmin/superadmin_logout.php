<!-- consultant_logout.php -->
<?php
session_start();

// Destroy the SuperAdmin's session
session_destroy();

// Redirect to the SuperAdmin login page after logout
header("Location: ../admin_login.php");
exit;
?>
