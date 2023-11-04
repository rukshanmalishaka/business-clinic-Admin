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
$sql = "SELECT * FROM editor WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

require_once 'notifycount.php';

// Close the connection
$conn->close();

// Include the TCPDF library
require_once 'tcpdf/tcpdf.php';

// ... (existing code) ...

// Add the following code at the end of the PHP section, just before the </html> tag:

// Function to generate and download PDF
function generatePDF($data, $filename) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Session Data PDF');
    $pdf->SetSubject('Session Data');
    $pdf->SetKeywords('Session, Data, PDF');

    // Set margins
    $pdf->SetMargins(15, 15, 15);

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('dejavusans', '', 12);

    // Add content to the PDF
    $pdf->WriteHTML($data);

    // Close and output the PDF
    $pdf->Output($filename, 'D');
}

// Check if the "Download PDF" button is clicked
if (isset($_POST['download_pdf'])) {
    // Get the data to be included in the PDF
    $pdfData = "
        <h2>Collected Data During Session</h2>
        <p>Session Date: {$row['created']}</p>
        <p>Consultant Name: {$row['consultant_name']}</p>
        <p>Client Name: {$row['client_name']}</p>
        <p>Client NIC: {$row['client_nic']}</p>
        <p>Client Email: {$row['email']}</p>
        <p>Phone Number: {$row['phone_number']}</p>
        <h3>Issues</h3>
        <p>{$row['issues']}</p>
        <h3>Requirements</h3>
        <p>{$row['requirments']}</p>
        <h3>Recommendation / Action</h3>
        <p>{$row['recommendation_action']}</p>
        <h3>Notes By Consultant</h3>
        <p>{$row['notes_to_admin']}</p>
    ";

    // Generate and download the PDF
    generatePDF($pdfData, $row['client_name']." ". 'session_data.pdf');
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
                                
                                <h2 class="page-title">Collected Data During Session</h2>
                                <ol class="breadcrumb">
                                    <li><a href="index.php">Dashboard</a></li>
                                    <li><a href="consult_session_history.php">Session History</a></li>
                                    <li class="active">Session Data Page</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title">Session Data with <?php echo $row['consultant_name']; ?> on <?php echo $row['created']; ?></h4><br>
					
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled"> 
                                                <li class="task-success">
                                                    <h5><b>Session Date : </b> <?php echo $row['created']; ?></h5>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Consultant Name : </b> <?php echo $row['consultant_name']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Client Name : </b> <?php echo $row['client_name']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Client NIC : </b> <?php echo $row['client_nic']; ?></h5>
                                                 </li>
                                            </ul>
                                        
                                        </div>
                                    </div>
                                    
                                     <div class="col-lg-4">
                                        <div>
                                            <ul class="taskList list-unstyled">
                                                 <li class="task-success">
                                                    <h5><b>Client Email : </b> <?php echo $row['email']; ?></h5>
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
                                </div>
                           <div> 
                           
                                <ul class="nav nav-tabs tabs hidden-xs">
                                    <li class="active tab">
                                        <a href="#home-2" data-toggle="tab" aria-expanded="false"> 
                                           <span class="hidden-xs portlet-title">Issues</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#profile-2" data-toggle="tab" aria-expanded="false"> 
                                          <span class="hidden-xs">Requirements</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#messages-2" data-toggle="tab" aria-expanded="true"> 
                                           <span class="hidden-xs">Recommendation / Action</span> 
                                        </a> 
                                    </li> 
                                    <li class="tab"> 
                                        <a href="#messages-3" data-toggle="tab" aria-expanded="true"> 
                                           <span class="hidden-xs">Notes By Consultant</span> 
                                        </a> 
                                    </li> 
                                   
                                </ul> 
                                <div class="tab-content hidden-xs"> 
                                    <div class="tab-pane active" id="home-2"> 
                                        <?php echo $row['issues']; ?>
                                    </div> 
                                    <div class="tab-pane" id="profile-2">
                                         <?php echo $row['requirments']; ?>
                                    </div> 
                                    <div class="tab-pane" id="messages-2">
                                        <?php echo $row['recommendation_action']; ?>
                                    </div> 
                                    <div class="tab-pane" id="messages-3">
                                        <?php echo $row['notes_to_admin']; ?>
                                    </div> 
                                
                                    
                                </div> 
                                
                                
                          <!-- mobile view accordian -->
                             
                        <div class="row">
                            
                            
                          
                            <div class="col-lg-12 visible-xs"> 
                                <div class="panel-group" id="accordion-test-2"> 
                                    <div class="panel panel-default"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                    Issues
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseOne-2" class="panel-collapse collapse"> 
                                            <div class="panel-body">
                                                 <p><?php echo $row['issues']; ?></p>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="panel panel-default"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                    Requirements
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseTwo-2" class="panel-collapse collapse"> 
                                            <div class="panel-body">
                                                <p><?php echo $row['requirments']; ?></p>
                                            </div> 
                                        </div> 
                                    </div> 
                                    <div class="panel panel-default"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                                    Recommendation / Action
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseThree-2" class="panel-collapse collapse"> 
                                            <div class="panel-body">
                                               <p><?php echo $row['recommendation_action']; ?></p>
                                            </div> 
                                        </div> 
                                    </div> 
                                    
                                    <div class="panel panel-default"> 
                                        <div class="panel-heading"> 
                                            <h4 class="panel-title"> 
                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseFour-2" class="collapsed" aria-expanded="false">
                                                    Notes By Consultant
                                                </a> 
                                            </h4> 
                                        </div> 
                                        <div id="collapseFour-2" class="panel-collapse collapse"> 
                                            <div class="panel-body">
                                               <p><?php echo $row['notes_to_admin']; ?></p>
                                            </div> 
                                        </div> 
                                    </div> 
                                    
                                </div> 
                            </div>
                        </div>
                        
                        <!-- Add a download button -->
                        <form method="post">
                            <button type="submit" name="download_pdf" class="btn btn-primary">Download PDF</button>
                        </form>
                        
                               
                        
                            </div> 

                	            </div>
							</div>
						</div>

            		</div> <!-- container -->
                               
                </div> <!-- content -->
         

              <?php include "inc/footer.php" ?>    
	</body>
</html>