<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    // If the admin is not logged in, redirect to the admin login page
    header("Location: admin_login.php");
    exit;
}

// Retrieve admin information based on the logged-in username
$loggedInAdminUsername = $_SESSION['admin_id'];

require_once 'config.php';

$sql = "SELECT * FROM admin_user WHERE username='$loggedInAdminUsername'";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();

require_once 'notifycount.php';

// Count the number of pending consultants
    $sqlSuggested = "SELECT COUNT(*) AS suggested_count FROM consultant_registration WHERE status = 'suggested'";
    $resultSuggested = $conn->query($sqlSuggested);
    $SuggestedCount = $resultSuggested->fetch_assoc()['suggested_count'];
    
// Count the number of Users
    $sqlUser = "SELECT COUNT(*) AS user_count FROM user_registration";
    $resultUser = $conn->query($sqlUser);
    $UserCount = $resultUser->fetch_assoc()['user_count'];
    
// Count the number of Sessions
    $sqlSession = "SELECT COUNT(*) AS session_count FROM editor";
    $resultSession = $conn->query($sqlSession);
    $SessionCount = $resultSession->fetch_assoc()['session_count'];
    
// Count the number of Approved consultants
    $sqlApproved = "SELECT COUNT(*) AS approved_count FROM consultant_registration WHERE status = 'approved'";
    $resultApproved = $conn->query($sqlApproved);
    $ApprovedCount = $resultApproved->fetch_assoc()['approved_count'];

$conn->close();


?>

<?php include "inc/header.php"; ?>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <?php include "inc/topbar.php"; ?>

        <?php include "inc/layout.php"; ?>

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <h2>Welcome Back! <?php echo $admin['username']; ?></h2><br>

                    <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                
                                	<h4 class="text-dark">Suggested Consultants</h4>
                                	<h2 class="text-primary text-center"><span data-plugin="counterup"><?php echo $SuggestedCount; ?></span></h2>
                                	<p class="text-muted">Still Not Approved by Super Admin</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                
                                	<h4 class="text-dark">Users</h4>
                                	<h2 class="text-pink text-center"><span data-plugin="counterup"><?php echo $UserCount; ?></span></h2>
                                	<p class="text-muted">Registered Clients</p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                
                                	<h4 class="text-dark">Consultation Sessions</h4>
                                	<h2 class="text-success text-center"><span data-plugin="counterup"><?php echo $SessionCount; ?></span></h2>
                                	<p class="text-muted">Number of Previous Sessions <span class="pull-right"></p>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                
                                	<h4 class="text-dark">Consultants</h4>
                                	<h2 class="text-warning text-center"><span data-plugin="counterup"><?php echo $ApprovedCount; ?></span></h2>
                                	<p class="text-muted">Approved Consultants</p>
                                </div>
                            </div>

                        </div>

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include "inc/footer.php"; ?>
        </div>
    </div>
</body>

</html>
