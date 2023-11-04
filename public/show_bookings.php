<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: admin_login.php");
    exit();
}

require_once 'config.php';

// Retrieve booking details along with full data from client and consultant
$sql = "SELECT b.id, c.first_name AS consultant_first_name, c.last_name AS consultant_last_name,
               u.first_name AS client_first_name, u.last_name AS client_last_name,
               b.scheduled_date, b.payment_amount, b.payment_status,b.booking_reference_code
        FROM booking_table b
        INNER JOIN consultant_registration c ON b.consultant_id = c.id
        INNER JOIN user_registration u ON b.client_id = u.id";

$result = $conn->query($sql);

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
                    
                        <h4 class="page-title">All Bookings</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>
                            
                            <li class="active">
                               All Bookings List
                            </li>
                        </ol>
                    </div>
                </div>


            
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <h4 class="m-t-0 header-title"><b>All Bookings List</b></h4><br>
                           

                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reference Code</th>
                                    <th>Client Name</th>
                                    <th>Consultant Name</th>
                                    <th>Scheduled Date</th>
                                    <th>Payment</th>
                                    <th>Payment Status</th>
                                    <th>Session Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                
                                 <?php
                                 
                                 $counter = 1; // Initialize the row counter
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $counter . "</td>"; // Display the row number
                                         echo "<td>" . $row["booking_reference_code"] . "</td>";
                                        echo "<td>" . $row["client_first_name"] . " " . $row["client_last_name"] . "</td>";
                                        echo "<td>" . $row["consultant_first_name"] . " " . $row["consultant_last_name"] . "</td>";
                                        echo "<td>" . $row["scheduled_date"] . "</td>";
                                        echo "<td>" . $row["payment_amount"] . "</td>";
                                        echo "<td>" . $row["payment_status"] . "</td>";
                                       
                                        // Get the current date in the same format as the scheduled date
                                        $currentDate = date("Y-m-d");
                            
                                        // Check if the session date is in the future or not
                                        if ($row["scheduled_date"] < $currentDate) {
                                            echo "<td>Expired Session</td>";
                                        } else {
                                            echo "<td style='color: green;'><b>Upcoming Session</b></td>";
                                        }
                                        
                                        // Check if payment is pending and show the "Mark as Paid" button with a form
                                            if ($row["payment_status"] == "Pending") {
                                                echo "<td>";
                                                echo "<form method='post' action='mark_paid.php'>";
                                                echo "<input type='hidden' name='booking_reference_code' value='" . $row["booking_reference_code"] . "'>";
                                                echo "<input class='btn btn-primary' type='submit' value='Mark as Paid'>";
                                                echo "</form>";
                                                echo "</td>";
                                            } else {
                                                echo "<td><span class='label label-success'>Payment Successful</span></td>"; // Empty cell for rows with paid status
                                            }
                                                                                                             
                                        echo "</tr>";
                                        $counter++; // Increment the row counter
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


      
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

      <?php include "inc/footer.php" ?>


<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>

</body>
</html>














