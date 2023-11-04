<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to login page or show an error message
    header("Location: admin_login.php");
    exit();
}


require_once 'config.php';

// Retrieve consultant data from the database (approved)
$sql = "SELECT * FROM user_registration ORDER BY id DESC";
$result = $conn->query($sql);

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
                    
                        <h4 class="page-title">All Users List</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="index.php">Dashboard</a>
                            </li>
                            <li>
                                <a href="all_users.php">All Users</a>
                            </li>
                            <li class="active">
                                All Registerd Users
                            </li>
                        </ol>
                    </div>
                </div>
                
                
                
                
                
                
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                             <h4 class="m-t-0 header-title"><b>All Registerd Users (Clients)</b></h4><br>
                            
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>NIC</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Mariital Status</th>
                                    <th>Registered Date</th>
                                    
                                    
                                </tr>
                                </thead>

                                <tbody>
                                    
                                    <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['first_name'] . "</td>";
                                        echo "<td>" . $row['last_name'] . "</td>";
                                        echo "<td>" . $row['nic'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone_number'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['marital_status'] . "</td>";
                                        echo "<td>" . $row['registration_date'] . "</td>";
                                        
                                         
                                         
                                        echo "</tr>";
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
        
        <script>
                        function confirmReject() {
                            return confirm("Are you sure you want to Delete this user?");
                        }
                        </script>

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