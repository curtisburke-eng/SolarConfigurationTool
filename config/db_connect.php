<?php
    // connect to the database
    $conn = mysqli_connect('localhost','pi','password','SolarConfigurationTool');

    // Check Connection
    if(!$conn) {
        echo 'Database Connection Error: ' . mysqli_connect_error();
    }
?>