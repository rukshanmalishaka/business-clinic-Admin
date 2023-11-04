<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: ../admin_login.php");
    exit();
}

// Include the database configuration file
require_once 'db.php';

// Count the number of pending consultants
$sqlCount = "SELECT COUNT(*) AS suggested_count FROM consultant_registration WHERE status = 'suggested'";
$resultCount = $db->query($sqlCount);
$suggestedCount = $resultCount->fetch_assoc()['suggested_count'];

// If the form is submitted
if (isset($_POST['submit'])) {
    // Get editor content
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    
    // Perform password validation
    if ($password !== $confirm_password) {
        $pw = "Passwords do not match";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare and execute the INSERT query
        $stmt = $db->prepare("INSERT INTO admin_user (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $userName, $hashed_password, $email, $role);
        
        if ($stmt->execute()) {
            // Insertion successful
            $successMsg = "Admin added successfully";
        } else {
            // Insertion failed
            $errorMsg = "Error: " . $stmt->error;
        }

    

        // Close the statement
        $stmt->close();
        
    }
}

?>




<?php include "inc/header.php" ?>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    <?php include "inc/topbar.php" ?>

    <?php include "inc/layout.php" ?>

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">

                        <h4 class="page-title">Add New Admin</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>

                            <li class="active">
                                Create New Admin
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-box table-responsive">

                            <h4 class="m-t-0 header-title"><b>Create New Admin</b></h4><br>

                            <form method="post" action="" enctype="multipart/form-data">

                                <div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" required><br>

                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" required><br>
                                        
                                        <label class="control-label " for="role">Role</label>
                                            <select class="form-control" name="role" id="role" required>
                                                <option value="admin" selected>Admin</option>
                                                <option value="superadmin">Super Admin</option>
                                            </select><br>

                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" name="password" id="password" required><br>

                                        <label for="confirm_password">Confirm Password:</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required><br>


                                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
                                            Add Admin
                                        </button><br><br>

                                        <!-- Error message display -->

                                        <?php
                                        if (isset($pw)) {
                                            echo ' <div class="alert alert-danger"><strong>Error: </strong>' . $pw . '</div>';
                                        }

                                        

                                        if (isset($errorMsg)) {
                                            echo ' <div class="alert alert-danger"><strong>Error: </strong>' . $errorMsg . '</div>';
                                        }

                                        if (isset($successMsg)) {
                                            echo ' <div class="alert alert-success"><strong>Well done! </strong>' . $successMsg . '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
        <?php include "inc/footer.php" ?>
</body>

</html>
