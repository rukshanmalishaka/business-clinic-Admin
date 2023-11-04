  <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                                <a href="index.php" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
                                
                            </li>
                            
                            <li class="has_sub">
                                <a href="consult_session_history.php" class="waves-effect"><i class="ti-reload"></i> <span> Session History </span></a>
                                
                            </li>
                            
                            <li class="text-muted menu-title">Consultants</li>

                            
                            <li class="has_sub">
                                <a href="pending_consultants.php" class="waves-effect"><i class="ti-time"></i> <span> Suggested  <?php if ($suggestedCount > 0): ?> <span class="badge badge-xs badge-danger"><?php echo $suggestedCount; ?></span><?php endif; ?></span></span></a>
                                
                            </li>
                            
                            <li class="has_sub">
                                <a href="all_consultants.php" class="waves-effect"><i class="icon-people"></i> <span> All Consultants </span></a>
                                
                            </li>
                            <li class="has_sub">
                                <a href="rejected_consultants.php" class="waves-effect"><i class="ti-na"></i> <span> Rejected Consultants </span></a>
                                
                            </li>
                            
                             <li class="text-muted menu-title">Session Bookings</li>
                            
                             <li class="has_sub">
                                <a href="add_booking.php" class="waves-effect"><i class="ti-plus"></i> <span>Add Booking</span></a>
                                
                            </li>
                            
                            <li class="has_sub">
                                <a href="show_bookings.php" class="waves-effect"><i class="ti-star"></i> <span>All Bookings</span></a>
                                
                            </li>
                            
                            <li class="text-muted menu-title">Users</li>
                            
                            <li class="has_sub">
                                <a href="all_users.php" class="waves-effect"><i class="ti-user"></i> <span> All Users </span></a>
                                
                            </li>

                            <li class="text-muted menu-title">Settings</li>
                            
                            <li class="has_sub">
                                <a href="create_admin.php" class="waves-effect"><i class="icon-user-follow"></i><span>Create New Admin</span></a>
                            
                            </li>

                            <li class="has_sub">
                                <a href="password_change.php" class="waves-effect"><i class="ti-unlock"></i><span>Change Password</span></a>
                            
                            </li>
                            <li class="has_sub">
                                <a href="superadmin_logout.php" class="waves-effect"><i class="ti-power-off"></i><span>Logout</span></a>
                            
                            </li>
                          

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->