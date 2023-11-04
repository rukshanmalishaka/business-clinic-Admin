<?php
// Include the database configuration file
require_once 'db.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: ../admin_login.php");
    exit();
}

require_once 'config.php';

// Get the ID from the URL parameter (created date)
$id = $_GET['id'];

// Fetch data from the database based on the ID (created date)
$sql = "SELECT * FROM consultant_registration WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

require_once 'notifycount.php';

// Close the connection
$conn->close();
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
                                
                                <h2 class="page-title">Full Details of Consultant</h2>
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Dashboard</a></li>
                                    
                                    <li class="active">Show All</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-10">
								<div class="card-box">
									<h4 class="m-t-0 header-title">All Data of <b><?php echo $row['first_name']; ?></b></h4><br>
						
                                <div class="row">
                            
                            
                            <div class="col-lg-12 col-md-8">
                                
                                  <center>
                                      <a class="btn btn-default" href="<?php echo $row['cv']; ?>" target="_blank">View CV</a>
                                      <a class="btn btn-inverse" href="<?php echo $row['cv']; ?>" download>Download CV</a>
                                  </center><br>
                                  
                                  
                                <div class="card-box">
                                    
                                         <div class="row">
                                             
                                    
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled"> 
                                                <li class="task-success">
                                                    <h5><b>Full Name : </b> <?php echo $row['first_name'] ." ". $row['last_name']; ?></h5>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Email : </b> <?php echo $row['email']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>NIC / Passport : </b> <?php echo $row['nic']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Phone Number : </b> <?php echo $row['phone_number']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Date of Birth : </b> <?php echo $row['date_of_birth']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Marital Status : </b> <?php echo $row['marital_status']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Currently Employed : </b> <?php echo $row['are_you_currently_employed']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Areas of Expertise : </b> <?php echo $row['areas_of_expertise']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Mode of Payment : </b> <?php echo $row['preferred_mode_of_payment']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Permanent Address : </b> <?php echo $row['permanent_address']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Current Address : </b> <?php echo $row['current_address']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Any Other Comment : </b> <?php echo $row['any_other_comments']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                </div>
                                     

                                 
                                    
                                   
                                </div>
                            </div>

                        </div>
                                    
                                   <?php
                                        // Assuming $status contains the status from the consultant_registration table
                                        if ($row['status'] == 'approved') {
                                            // Show the Reject button form
                                            ?>
                                            <form action="reject_consultant.php" method="post">
                                                <input type="hidden" name="consultant_id" value="<?php echo $row['id']; ?>">
                                                <input class="btn btn-danger" type="submit" value="Reject Consultant" onclick="return confirmReject();">
                                            </form>
                                            <?php
                                        } elseif ($row['status'] == 'suggested') {
                                            // Show the Approve button form
                                            ?>
                                            <form action="approve_consultant.php" method="post">
                                                <input type="hidden" name="consultant_id" value="<?php echo $row['id']; ?>">
                                                <input class="btn btn-primary" type="submit" value="Approve Consultant" onclick="return confirmApprove();">
                                            </form>
                                            <?php
                                        } else {
                                            // Handle other cases if needed
                                        }
                                    ?>

                                    
                                    
                                        

	</div>
							</div>
						</div>

            		</div> <!-- container -->
                               
                </div> <!-- content -->
         
                    <script>
                    function confirmReject() {
                        return confirm("Are you sure you want to reject this consultant?");
                    }
                    </script>
                    
                    <script>
                    function confirmApprove() {
                        return confirm("Are you sure you want to Approve this consultant?");
                    }
                    </script>
                    
              <?php include "inc/footer.php" ?>    
	</body>
</html>