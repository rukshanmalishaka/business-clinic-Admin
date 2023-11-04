<!-- admin_login.php -->
<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    // If the admin is already logged in, redirect based on role
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($_SESSION['role'] === 'superadmin') {
        header("Location: superadmin/superadmin_dashboard.php");
    } else {
        // If the role is not recognized, redirect to some default page
        header("Location: default_dashboard.php");
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate login credentials against the admin_users table
    $query = "SELECT * FROM admin_user WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Login successful, set up a session for the admin
            $_SESSION['admin_id'] = $username;
            $_SESSION['role'] = $admin['role']; // Store the role in the session

            // Check the role and redirect accordingly
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($_SESSION['role'] === 'superadmin') {
                header("Location: superadmin/superadmin_dashboard.php");
            } else {
                // If the role is not recognized, redirect to some default page
                header("Location: default_dashboard.php");
            }
            exit;
        } else {
            $loginError = "Invalid username or password. Please try again.";
        }
    } else {
        $loginError = "Invalid username or password. Please try again.";
    }

    $conn->close();
}
?>


<?php include "inc/header.php" ?>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Log In to <strong class="text-custom">BusinessClinic.LK</strong> </h3>
            </div> 
                
            

            <div class="panel-body">
                <?php
                    if (isset($loginError)) {
                        echo ' <div class="alert alert-danger"><strong>Error: </strong>'. $loginError .'</div>';
                       
                    }
                    ?>
            <form action="admin_login.php" class="form-horizontal m-t-20" method="post">
                
                    <div class="form-group ">
                    
                        <div class="col-xs-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
        
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox" name="remember" <?php echo isset($_COOKIE['remember_username']) ? 'checked' : ''; ?>>
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            
                                <?php  
                                if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                                    // Set a cookie to remember the username for 30 days (time() + 30 days)
                                    setcookie('remember_username', $username, time() + (30 * 24 * 60 * 60));
                                } else {
                                    // If "Remember me" is unchecked, remove the cookie (set it to a past time)
                                    setcookie('remember_username', '', time() - 3600);
                                }
                                ?>

                            </div>
                        </div>
                    </div>

                
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                   
                </form> 
            
            </div>   
            </div> 
        </div>
        
        <script>
            var resizefunc = [];
        </script>

   <?php include "inc/footer.php" ?>
    </body>
</html>
