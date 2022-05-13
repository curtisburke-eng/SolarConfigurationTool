<?php
    // Conect to the database
    include('../config/db_connect.php');

    // Check data for malitious SQL code
    $dimensions = mysqli_real_escape_string($conn, $_POST['dimensions']);
    $doors = mysqli_real_escape_string($conn, $_POST['doors']);
    $windows = mysqli_real_escape_string($conn, $_POST['windows']);
    $insulation = mysqli_real_escape_string($conn, $_POST['insulation']);
    $siding = mysqli_real_escape_string($conn, $_POST['siding']);
    $siding_color = mysqli_real_escape_string($conn, $_POST['siding_color']);
    $roof = mysqli_real_escape_string($conn, $_POST['roof']);
    $roof_color = mysqli_real_escape_string($conn, $_POST['roof_color']);
    $interior = mysqli_real_escape_string($conn, $_POST['interior']);
    $int_floor = mysqli_real_escape_string($conn, $_POST['int_floor']);
    $int_walls = mysqli_real_escape_string($conn, $_POST['int_walls']);
    $int_ceiling = mysqli_real_escape_string($conn, $_POST['int_ceiling']);
    $foundation = mysqli_real_escape_string($conn, $_POST['foundation']);
    $lifting_type = mysqli_real_escape_string($conn, $_POST['lifting_type']);
    $shed_notes = mysqli_real_escape_string($conn, $_POST['shed_notes']);

    //INSERT INFO INTO TABLE
    $query = "INSERT INTO shed_configs VALUES (NULL, '$dimensions', '$doors', '$windows', '$insulation', '$siding', '$siding_color', '$roof', '$roof_color', '$interior', '$int_floor', '$int_walls', '$int_ceiling', '$foundation', '$lifting_type', '$shed_notes', NOW())";
    $err  = mysqli_query($conn, $query);
    if(!$err) {
        //Error
        echo 'Query Error with device INSERT: ' . mysqli_error($conn);
    }

    //GET ID FOR FUTURE INSERTS
    $query = "SELECT id FROM shed_configs ORDER BY timestamp DESC LIMIT 1";
    $result  = mysqli_query($conn, $query);
    // Fetch Resulting Rows as an array
    $shed_id = mysqli_fetch_all($result, MYSQLI_NUM);
    $shed_id = $shed_id[0][0];
    // Print Results (for debugging)
    //print_r($shed_id);
    //echo $shed_id; 
    // Free resut from memory
    mysqli_free_result($result);

    // Store id to session global
    session_start();
    $_SESSION['shed_id'] = $shed_id;

    mysqli_close($conn);

?>