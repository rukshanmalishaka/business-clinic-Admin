<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: ../admin_login.php");
    exit();
}

$servername = "localhost";
$username = "refectli_TestPhp";
$password = "TestPhp#123";
$dbname = "refectli_testphp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random booking reference code
function generateBookingReferenceCode() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $bookingCode = '';
    for ($i = 0; $i < 8; $i++) {
        $bookingCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $bookingCode;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submit"])) {
        // Get the form data
        $consultantId = $_POST["consultant"];
        $clientId = $_POST["client"];
        $scheduledDate = $_POST["scheduled_date"];
        $paymentAmount = $_POST["payment_amount"];
        $paymentStatus = $_POST["payment_status"];
        
        // Generate a random booking reference code
    $bookingReferenceCode = generateBookingReferenceCode();

        // Insert data into the booking MySQL table
        $sql = "INSERT INTO booking_table (consultant_id, client_id, scheduled_date, payment_amount, payment_status,booking_reference_code) 
                VALUES ('$consultantId', '$clientId', '$scheduledDate', '$paymentAmount', '$paymentStatus', '$bookingReferenceCode')";

        if ($conn->query($sql) === TRUE) {
            echo "Booking added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

require_once 'notifycount.php';

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
                    
                        <h4 class="page-title">Add Booking</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>
                            
                            <li class="active">
                                Make Consultant Session Booking
                            </li>
                        </ol>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card-box table-responsive">

                            <h4 class="m-t-0 header-title"><b>Make Consultant Session Booking</b></h4><br>
                            
                        <form action="add_booking.php" method="post">
                            
                        
                            
                            <label for="consultant">Select Consultant:</label>
                            <select class="form-control select2" name="consultant" id="consultant-select">
                                <option value="" selected disabled>Select a Consultant</option>
                                <?php
                                // Fetch the list of consultants from the database
                                $query = "SELECT id,first_name, last_name,email FROM consultant_registration";
                                $result = $conn->query($query);
                    
                                // Loop through the results and create options for the select dropdown
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['first_name'] . " " . $row['last_name'] ." (" . $row['email'] .")". '</option>';
                                }
                                ?>
                            </select>
                            <br><br>
                            <label for="client">Select Client:</label>
                            <select class="form-control select2" name="client" id="client-select">
                                <option value="" selected disabled>Select a Client</option>
                                <?php
                                // Fetch the list of consultants from the database
                                $query = "SELECT id,first_name, last_name,email FROM user_registration";
                                $result = $conn->query($query);
                    
                                // Loop through the results and create options for the select dropdown
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['first_name'] . " " . $row['last_name'] ." (" . $row['email'] .")". '</option>';
                                }
                                ?>
                            </select>
                            <br><br>
                            
                            <label for="scheduled_date">Scheduled Date:</label>
                            <input class="form-control" type="date" id="scheduled_date" name="scheduled_date"><br>
                            
                            <label for="payment_amount">Payment Amount (in rupees):</label>
                        <input class="form-control" type="number" id="payment_amount" name="payment_amount" required><br>

                    <label for="payment_status">Payment Status:</label>
                    <select class="form-control" id="payment_status" name="payment_status" required>
                        <option value="Paid">Paid</option>
                        <option value="Pending">Pending</option>
                        <option value="Cancelled">Cancelled</option>
                    </select><br>
                            
                            <!-- Add other reservation fields here (e.g., name, email, etc.) -->
                            <Button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">Book</button>
                        </form>
                        
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
        
       
      <?php include "inc/footer.php" ?>
      
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
       
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
      

        <script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>
</body>
</html>


        

