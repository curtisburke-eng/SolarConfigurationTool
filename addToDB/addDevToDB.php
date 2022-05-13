<?php
    // Conect to the database
    include('../config/db_connect.php');

    // Check data for malitious SQL code
    $dev_name = mysqli_real_escape_string($conn, $_POST['dev_name']);
    $dev_desc = mysqli_real_escape_string($conn, $_POST['dev_desc']);
    $amps = mysqli_real_escape_string($conn, $_POST['amps']);
    $watts = mysqli_real_escape_string($conn, $_POST['watts']);

    // Check & Update amp and watt values
    if(empty($_POST['amps'])) {
        $amps = $watts / 120;
    }
    if(empty($_POST['watts'])) {
        $watts = $amps * 120;
    }

    //CHECK IF dev_name AND watt COMBO EXISTS
    $query = "SELECT EXISTS(SELECT * FROM loads WHERE device_name = '$dev_name' AND watts = $watts)";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $dev_exists = mysqli_fetch_all($result, MYSQLI_NUM);
    $dev_exists = $dev_exists[0][0];
    // Print Results (for debugging)
    //print_r($dev_exists);
    //echo $dev_exists;
    // Free resut from memory
    mysqli_free_result($result);

    // If device- watt COMBO DOES NOT exist in db => add it
    if(!$dev_exists) {
        $query = "INSERT INTO loads VALUES (NULL, '$dev_name','$dev_desc', $amps, $watts)";
        $err  = mysqli_query($conn, $query);
        if(!$err) {
            //Error
            echo 'Query Error with device INSERT device: ' . mysqli_error($conn);
        } 
    }

    mysqli_close($conn);
?>