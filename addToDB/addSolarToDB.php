<?php

    // Conect to the database
    include('../config/db_connect.php');

    // Check data for malitious SQL code
    $device_array = $_POST['device_check'];
    $use_array = $_POST['use_list'];
    $solar_notes = mysqli_real_escape_string($conn, $_POST['solar_notes']);
 
    $device_list = '';
    $use_list = '';
    
    // Convert Arrays to comma Lists
    foreach($device_array as $device) {
        $device_list = $device_list . $device . ', ';
    }
    $device_list = rtrim($device_list, ", ");

    foreach($use_array as $elem) {
        $use_list = $use_list . $elem . ', ';
    } 
    $use_list = rtrim($use_list, ", ");


    if(empty($device_list)){
        $allowed_days = 0;
        $power_consumption_per_day = 0;
        $power_consumption = 0;        
        $inverter_size = 0;
        $num_batts = 0;
        $num_panels = 0;
    } else {    
        // DO SOLAR CONFIGURATION MATH
        include('../solarMath.php');
        
        // Extract SESSION varialbles
        session_start();
        $allowed_days = $_SESSION['allowed_days'];
        $power_consumption_per_day = $_SESSION['power_cons_day'];
        $power_consumption = $_SESSION['power_consumption'];
        $inverter_size = $_SESSION['inverter_size'];
        $num_batts = $_SESSION['num_batts'];
        $num_panels = $_SESSION['num_panels'];
    }
 
    // Conect to the database
    include('../config/db_connect.php');

    // Add Configuration to DB
    $query = "INSERT INTO solar_configs VALUES (NULL, '$device_list', '$use_list', $allowed_days, $power_consumption_per_day, $power_consumption, $inverter_size, $num_batts, $num_panels, '$solar_notes', NOW());";
    $err  = mysqli_query($conn, $query);
    if(!$err) {
        //Error
        echo 'Query Error with device INSERT: ' . mysqli_error($conn);
    }    

    //GET CUSTOMER ID FOR FUTURE INSERTS
    $query = "SELECT id FROM solar_configs ORDER BY timestamp DESC LIMIT 1";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $solar_id = mysqli_fetch_all($result, MYSQLI_NUM);
    $solar_id = $solar_id[0][0];
    // Print Results (for debugging)
    //print_r($solar_id);
    //echo $solar_id;
    // Free resut from memory
    mysqli_free_result($result);

    session_start();
    $_SESSION['solar_id'] = $solar_id;

    mysqli_close($conn);
?>