<?php

    // Count the number of pending consultants
    $sqlCount = "SELECT COUNT(*) AS pending_count FROM consultant_registration WHERE status = 'pending'";
    $resultCount = $conn->query($sqlCount);
    $pendingCount = $resultCount->fetch_assoc()['pending_count'];


?>