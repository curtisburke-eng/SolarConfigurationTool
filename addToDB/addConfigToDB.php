<?php

    // Conect to the database
    include('../config/db_connect.php');

    // Extract SESSION variables
    session_start();
    $cust_id = $_SESSION['cust_id'];
    $msu_id = $_SESSION['msu_id'];
    $shed_id = $_SESSION['shed_id'];
    $solar_id = $_SESSION['solar_id'];
    
    // Debugging 
    /*
    echo 'cust_id: ' . $cust_id . '<br />';
    echo 'msu_id: ' . $msu_id . '<br />';
    echo 'shed_id: ' . $shed_id . '<br />';
    echo 'solar_id: ' . $solar_id . '<br />';
    */
    
    if(empty($msu_id)) {
        $query = "INSERT INTO configs VALUES (NULL, $cust_id, NULL, $shed_id, $solar_id, NOW())";
    }
    if(empty($shed_id)) {
        $query = "INSERT INTO configs VALUES (NULL, $cust_id, $msu_id, NULL, $solar_id, NOW())";
    }

    // Add Configuration to DB
    
    $err  = mysqli_query($conn, $query);
    if(!$err) {
        //Error
        echo 'Query Error with device INSERT config: ' . mysqli_error($conn) . '<br />';
    }    


    mysqli_close($conn);
?>