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

// Fetch the form data for the logged-in consultant
$sql = "SELECT * FROM editor ORDER BY created DESC";

$result = $conn->query($sql);

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
                    
                        <h4 class="page-title">Consultation Session History</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li>
                                <a href="consult_session_history.php">Session History</a>
                            </li>
                            <li class="active">
                                All Sessions List
                            </li>
                        </ol>
                    </div>
                </div>
                
                
                
                
                
                
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                             <h4 class="m-t-0 header-title"><b>All Sessions List</b></h4><br>
                            
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Consultant Name</th>
                                    <th>Client Name</th>
                                    <th>Client NIC</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Session Date</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>


                                <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['consultant_name'] . "</td>";
                                        echo "<td>" . $row['client_name'] . "</td>";
                                        echo "<td>" . $row['client_nic'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone_number'] . "</td>";
                                        echo "<td>" . $row['created'] . "</td>";
                                         echo "<td><a class='btn btn-default' href='view_data.php?id=" . $row['id'] . "'>View</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No data found.</td></tr>";
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