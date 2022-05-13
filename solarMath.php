<?php

    // Conect to the database
    include('../config/db_connect.php');

    // Calculation Variables
    $allowed_days = $_POST['allowed_days']; // allowable days without recharge
    $panel_size = 410; // W
    $battery_size = 300; //Ah

    $device_array = $_POST['device_check'];
    $use_array = $_POST['use_list'];

    foreach($device_array as $device) {
        //GET CUSTOMER ID FOR FUTURE INSERTS
        $query = "SELECT watts FROM loads WHERE device_name = '$device'";
        $result  = mysqli_query($conn, $query);
        // Fetch Resulting Rows as an array
        $watt = mysqli_fetch_all($result, MYSQLI_NUM);
        $watt_array[] = $watt[0][0];
        // Print Results (for debugging)
        //print_r($watt_array);
        //echo $watt;
        // Free resut from memory
        mysqli_free_result($result);

    }

    // Power Consumption (at a single time)
    $power_consumption = array_sum($watt_array);
    $inflated_pwr_cons = $power_consumption * 1.2; // Inflated for overdraw
    //echo 'Inflated Pwr Cons: ' . $inflated_pwr_cons . '<br />';

    // Power Consumption (Per day)
    $watt_hour = array_map(function($x, $y) { return $x * $y; },$use_array, $watt_array);
    //print_r($watt_hour);

    $power_consumption_per_day = array_sum($watt_hour); 
    $inflated_pwr_cons_per_day = $power_consumption_per_day * 1.2; // Inflated for overdraw
    //echo 'Inflated Pwr Cons (Per day): ' . $inflated_pwr_cons_per_day . '<br />';

    
    // Inverter Size
    $inverter_size = abs(round(($inflated_pwr_cons + 500), -3));
    //echo 'Inverter Size: ' . $inverter_size . '<br />';

    // Battery Quantity
    $num_batts = ($inflated_pwr_cons_per_day * $allowed_days) / ($battery_size * 12 * 0.9); // 12V, 0.9 derating value
    $num_batts = abs(round(($num_batts ), 0));
    if($num_batts == 0) {
        $num_batts++;   // must have a min of 1 battery
    }
    session_start();
    if($_SESSION['unit_config'] == 'MSU' && $num_batts % 2 == 1) { // if unit is a MSR and even # of batteries are req (for 24V)
        $num_batts++;   // add a battery (round up)
    }
    //echo 'Number of Batteries: ' . $num_batts . '<br />';

    // Number of Panels
    $num_panels = $inflated_pwr_cons_per_day / ($panel_size * 5); // 5 = hours of sun per day (good est for CO)
    $num_panels = abs(round(($num_panels + 0.5), 0));
    //echo 'Number of Panels: ' . $num_panels . '<br />';


    // Save to SESSION varialbles
    session_start();
    $_SESSION['allowed_days'] = $allowed_days;
    $_SESSION['power_consumption'] = $power_consumption;
    $_SESSION['power_cons_day'] = $power_consumption_per_day;
    $_SESSION['inverter_size'] = $inverter_size;
    $_SESSION['num_batts'] = $num_batts;
    $_SESSION['num_panels'] = $num_panels;
    
    mysqli_close($conn);
?>
