<?php
    // Conect to the database
    include('../config/db_connect.php');

    // Check data for malitious SQL code
    $temp_range = mysqli_real_escape_string($conn, $_POST['temp_range']);
    $lifting_type = mysqli_real_escape_string($conn, $_POST['lifting_type']);
    $aux_package = mysqli_real_escape_string($conn, $_POST['aux_package']);
    $msu_notes = mysqli_real_escape_string($conn, $_POST['msu_notes']);

    //INSERT INFO INTO TABLE
    $query = "INSERT INTO msu_configs VALUES (NULL, '$temp_range','$lifting_type', '$aux_package', '$msu_notes', NOW())";
    $err  = mysqli_query($conn, $query);
    if(!$err) {
        //Error
        echo 'Query Error with device INSERT: ' . mysqli_error($conn);
    }

    //GET ID FOR FUTURE INSERTS
    $query = "SELECT id FROM msu_configs ORDER BY timestamp DESC LIMIT 1";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $msu_id = mysqli_fetch_all($result, MYSQLI_NUM);
    $msu_id = $msu_id[0][0];
    // Print Results (for debugging)
    //print_r($msu_id);
    //echo $msu_id;
    // Free resut from memory
    mysqli_free_result($result); 

    // Store id to session global
    session_start();
    $_SESSION['msu_id'] = $msu_id;

    mysqli_close($conn);

?>