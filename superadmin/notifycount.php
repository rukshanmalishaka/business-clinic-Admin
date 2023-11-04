<?php

    // Count the number of pending consultants
    $sqlCount = "SELECT COUNT(*) AS suggested_count FROM consultant_registration WHERE status = 'suggested'";
    $resultCount = $conn->query($sqlCount);
    $suggestedCount = $resultCount->fetch_assoc()['suggested_count'];


?>