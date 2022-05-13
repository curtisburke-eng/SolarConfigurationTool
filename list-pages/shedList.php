<?php
    // connect to the database
    include('../config/db_connect.php');
    session_start();
    // Write query for all shed configurations per customer
    $sql = 'SELECT configs.config_id AS config_id, shed_configs.id AS shed_id, dimensions, doors, windows, insulation, siding, siding_color, roof, roof_color, interior, int_floor, int_walls, int_ceiling, foundation, lifting_type, shed_configs.notes AS shed_notes, solar_configs.id AS solar_id, device_list, usage_list, allowed_days, power_cons_day, power_consumption, inverter_size, num_batts, num_panels, solar_configs.notes AS solar_notes FROM configs, shed_configs, solar_configs WHERE configs.shed_config = shed_configs.id AND configs.solar_config = solar_configs.id AND cust_id = ' . $_SESSION['cust_id'] . ' ORDER BY configs.timestamp DESC';
    
    // Make query & Get result
    $result  = mysqli_query($conn, $sql);
    // Fetch Resulting Rows as an array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Echo Results at the top for debugging
    //print_r($rows);
    // Free resut from memory
    mysqli_free_result($result);


    // GET CUSTOMER INFORMATION
    $sql = 'SELECT name, phone FROM customers WHERE cust_id = ' . $_SESSION['cust_id'];
    // Make query & Get result
    $result  = mysqli_query($conn, $sql);
    // Fetch Resulting Rows as an array
    $cust_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $name = $cust_info[0]['name'];
    $phone = $cust_info[0]['phone'];
    // Echo Results at the top for debugging
    //print_r($cust_info);
    //echo 'name: ' . $name . '<br />';
    //echo 'phone: ' . $phone . '<br />';
    // Free resut from memory
    mysqli_free_result($result);

?>

<!DOCTYPE html>
<html>

    <?php include('../templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Solar Shed Configurations</h4>
        <h6 class="center"><?php echo 'Name: ' . htmlspecialchars($name); ?></h6>
        <h6 class="center"><?php echo 'Phone: ' . htmlspecialchars($phone); ?></h6>

    </section>

    <div class="contrainer">
        <div class="row">
            <?php foreach($rows as $row): ?>
            
            <div class="col s12 md6 l4">

                

                <div class="card z-depth-0">
                    <div class="card-content center">
                        <div class="row"> <h5 class="left-align">System Requirements:</h5> </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Days without Recharge: '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['allowed_days']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php echo 'days' ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Number of Panels: '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['num_panels']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php  ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Number of Batteries: '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['num_batts']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php  ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Inverter Size: '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['inverter_size']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php echo 'W' ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Total Power Consumption (per day): '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['power_cons_day']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php echo 'W' ?> </div>
                        </div>    
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Power Consumption (at one time): '; ?> </div>
                            <div class="col s3 md3 l3 right-align"> <?php echo htmlspecialchars($row['power_consumption']); ?> </div>
                            <div class="col s1 md1 l1 right-align"> <?php echo 'W' ?> </div>
                        </div>
                        <div class="row left-align"> <?php echo 'Solar Configuration Notes: '; ?> </div>
                        <div class="row left-align"> 
                            <div class="col s12 md12 l12 left-align"> <?php echo htmlspecialchars($row['solar_notes']); ?> </div>
                        </div>

                        <div class="row"> <h5 class="left-align">Est. Device List:</h5> </div>
                        <div class="row"> 
                            <h6 class="col s5 md5 l5 left-align">Device Name:</h6>
                            <h6 class="col s3 md3 l3 left-align">Est. Usage Time (hr):</h6>
                            <h6 class="col s4 md4 l4 left-align">Power Consumption (W): </h6>
                        </div>
                        <?php 
                            $i=0;
                            $usage = explode(',',$row['usage_list']);
                            $devices = explode(',',$row['device_list']);
                            foreach($devices as $dev):
                                $dev = trim($dev);  
                        ?>
                            <div class="row"> 
                                <div class="col s5 md5 l5 left-align"> <?php echo htmlspecialchars($dev); ?> </div>
                                <div class="col s3 md3 l3 center-align"> <?php echo htmlspecialchars($usage[$i]); ?> </div>

                                <?php 
                                   
                                   // GET device watt INFORMATION
                                   $sql = "SELECT watts FROM loads WHERE device_name = '$dev'";
                                   // Make query & Get result
                                   $result  = mysqli_query($conn, $sql);
                                   // Fetch Resulting Rows as an array
                                   $watts = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                   $watts = $watts[0]['watts'];
                                   // Echo Results at the top for debugging
                                   //print_r($watts);
                                   //echo 'watts: ' . $watts . '<br />';
                                   // Free resut from memory
                                   mysqli_free_result($result);

                                ?>

                                <div class="col s4 md4 l4 center-align"> <?php echo htmlspecialchars($watts); ?> </div>
                            </div>
                        <?php 
                            $i++;
                            endforeach; 
                        ?>
                        
                        <div class="row"> <h5 class="left-align">Shed Construction:</h5> </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Dimensions: '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['dimensions']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Door(s): '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['doors']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Window(s): '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['windows']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Insulation: '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['insulation']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Siding: '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['siding_color']) . ' ' . htmlspecialchars($row['siding']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Roof: '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['roof_color']) . ' ' . htmlspecialchars($row['roof']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Interior: '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['interior']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s1 md1 l1"></div>
                            <div class="col s7 md7 l7 left-align"> <?php echo 'Interior Floor (if finished): '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['int_floor']); ?> </div>
                        </div>
                        <div class="row left-align">
                            <div class="col s1 md1 l1"></div> 
                            <div class="col s7 md7 l7 left-align"> <?php echo 'Interior Walls (if finished): '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['int_walls']); ?> </div>
                        </div>
                        <div class="row left-align">
                            <div class="col s1 md1 l1"></div>
                            <div class="col s7 md7 l7 left-align"> <?php echo 'Interior Ceiling (if finished): '; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['int_ceiling']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Foundation:'; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['foundation']); ?> </div>
                        </div>
                        <div class="row left-align"> 
                            <div class="col s8 md8 l8 left-align"> <?php echo 'Lifting Type:'; ?> </div>
                            <div class="col s4 md4 l4 right-align"> <?php echo htmlspecialchars($row['lifting_type']); ?> </div>
                        </div>
                        <div class="row left-align"> <?php echo 'Notes:'; ?> </div>
                        <div class="row left-align"> 
                            <div class="col s12 md12 l12 left-align"> <?php echo htmlspecialchars($row['shed_notes']); ?> </div>
                        </div>

                    </div>
                    
                    <div class="card-action right-align">
                        <a class="brand-text" href="/confirmDelete.php?id=<?php echo $row['config_id']; ?>">Delete Configuration</a>
                    </div>
                  
                    
                </div>

            </div>

            <?php endforeach; ?>


        </div>
    </div>

    <?php
        //End SESSION
        //session_unset();
        mysqli_close($conn);

    ?>


    <?php include('../templates/footer.php'); ?>

</html>
