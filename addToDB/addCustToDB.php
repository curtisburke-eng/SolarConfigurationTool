<?php
    // Conect to the database
    include('../config/db_connect.php');

    // Check data for malitious SQL code
    $cust_name = mysqli_real_escape_string($conn, $_POST['cust_name']);
    $cust_email = mysqli_real_escape_string($conn, $_POST['cust_email']);
    $cust_phone = mysqli_real_escape_string($conn, $_POST['cust_phone']);
    $cust_location = mysqli_real_escape_string($conn, $_POST['cust_location']);


    //CHECK IF customer phone number EXISTS
    $query = "SELECT EXISTS(SELECT * FROM customers WHERE phone = '$cust_phone')";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $cust_exists = mysqli_fetch_all($result, MYSQLI_NUM);
    $cust_exists = $cust_exists[0][0];
    // Print Results (for debugging)
    //print_r($cust_exists);
    //echo $cust_exists;
    // Free resut from memory
    mysqli_free_result($result);

    // If customer DOES NOT exist in db => add it
    if(!$cust_exists) {
        $query = "INSERT INTO customers VALUES (NULL, '$cust_name','$cust_email', '$cust_phone', '$cust_location')";
        $err  = mysqli_query($conn, $query);
        if(!$err) {
            //Error
            echo 'Query Error with device INSERT: ' . mysqli_error($conn);
        }
    }


    //GET CUSTOMER ID FOR FUTURE INSERTS
    $query = "SELECT cust_id FROM customers WHERE phone = '$cust_phone'";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $cust_id = mysqli_fetch_all($result, MYSQLI_NUM);
    $cust_id = $cust_id[0][0];
    // Print Results (for debugging)
    //print_r($cust_id);
    //echo $cust_id;
    // Free resut from memory
    mysqli_free_result($result);

    // Store id to session global 
    session_start();
    $_SESSION['cust_id'] = $cust_id;


    mysqli_close($conn);

?>