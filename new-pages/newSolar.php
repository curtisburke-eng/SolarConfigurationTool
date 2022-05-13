<?php 

    $solar_notes = '';
    $use_list = '';
    $allowed_days = 3;  // default value

    $errors = array('solar_notes' => '', 'use_list' => '', 'allowed_days' => '');
    
    if(isset($_POST['submit'])){
        
        // Check & Validate Allowed days
        if(empty($_POST['allowed_days'])) {
            $errors['allowed_days'] = 'Allowable days are required. <br />';
        } else {
            $allowed_days = $_POST['allowed_days'];
            if(!preg_match('/^[0-9]+$/', $allowed_days)) {
                $errors['allowed_days'] =  'Only digits allowed. <br />';
            }
        }

        // Check & Validate Notes
        if(empty($_POST['solar_notes'])) {
            //$errors['solar_notes'] = 'Notes are required. <br />';
        } else {
            $solar_notes = $_POST['solar_notes'];
            if(!preg_match('/^\b[a-zA-Z0-9\,\s]+\b$/', $solar_notes)) {
                $errors['solar_notes'] =  'Allowed: letters, numbers, spaces, commas. <br /> Cannot end with a comma or space.';
            }
        }

        // Check & Validate Use times list
        if(!empty($_POST['device_check'])) {  // IF devices are selected, use times are required:
            
            $use_list = array_intersect_key($_POST['use_list'],$_POST['device_check']);
            $_POST['use_list'] = $use_list;
            foreach($use_list as $elem) {
                if(empty($elem)) {
                    $errors['use_list'] =  'Est. use time is required for selected devices.';
                    break;
                } else {
                    if(!preg_match('/^\b[0-9\.]+\b$/', $elem)) {
                        $errors['use_list'] =  'Only digits (and decimal point) allowed.';
                        break;
                    }
                }
            }
        } else { //If NO devices are selected, use times must be empty (for server)
            $use_list = '';
            $_POST['use_list'] = $use_list;
        }

        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
            
        } else { // No errors in array

            // Add to database
            include('../addToDB/addSolarToDB.php');
            include('../addToDB/addConfigToDB.php');
            
            
            session_start();
 
            //Redirect to list pages
            if($_SESSION['unit_config'] == 'MSU') {
                header('Location: ../list-pages/MSRList.php');
            } elseif($_SESSION['unit_config'] == 'shed') {
                header('Location: ../list-pages/shedList.php');
            }
            
        }

    }

    // GET ALL DEVICED FROM LOADS TABLE
    // connect to the database
    include('../config/db_connect.php');
    // Write query for all device_names
    $sql = 'SELECT device_name, watts FROM loads ORDER BY device_name ASC';
    // Make query & Get result
    $result  = mysqli_query($conn, $sql);
    // Fetch Resulting Rows as an array
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Echo Results at the top for debugging
    //print_r($rows);
    // Free resut from memory
    mysqli_free_result($result);
    mysqli_close($conn);
    

?>


<!DOCTYPE html>
<html>

<?php include('../templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Solar Package Configuration</h4>
    <form class="white" action="newSolar.php" method="POST">

        <label>Allowable Days without Recharge: (Default: 3)</label>
        <input type="text" name="allowed_days" value="<?php echo htmlspecialchars($allowed_days); ?>">
        <div class="red-text"><?php echo $errors['allowed_days']; ?></div>
 
        <div class="row">
            <div class="col s7 md7 l7 left-align">
                <label>Device Selection:</label>
            </div>
            <div class="col s3 md3 l3 center">
                <label>Power Consumption (W):</label>
            </div>
            <div class="col s2 md2 l2 center">
                <label>Est. use time (hrs):</label>
                <div class="red-text"><?php echo $errors['use_list']; ?></div>
            </div>
        </div>
        <div class="input-field">
            <?php foreach($rows as $device): ?>

                <div class="row">
                    <div class="col s7 md7 l7">
                        <label>
                        <input type="checkbox" class="filled-in" <?php echo 'name="device_check[' . $device['device_name'] .']"'; ?> <?php echo 'value="' . $device['device_name'] . '"'; ?> <?php if(in_array($device['device_name'],$_POST['device_check'])) echo "checked='checked'"; ?>  >
                        <span> <?php echo $device['device_name'] ?> </span>
                        </label>
                    </div>
                    <div class="col s3 md3 l3 center">
                            <?php echo $device['watts']; ?>
                    </div>
                    <div class="col s2 md2 l2">
                            <input type="text" <?php echo 'name="use_list[' . $device['device_name'] .']"'; ?> value=<?php echo '"' . htmlspecialchars($use_list[$device['device_name']]) . '"'; //if(in_array($device['device_name'],$_POST['device_check'])) echo '"' . htmlspecialchars($use_list[$device['device_name']]) . '"'; ?> >
                    </div>

                </div>

            <?php endforeach; ?>
            
        </div>
        
        <label>Notes: (optional)</label>
        <input type="text" name="solar_notes" value="<?php echo htmlspecialchars($solar_notes); ?>">
        <div class="red-text"><?php echo $errors['solar_notes']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
        
    </form>
</section>

<?php include('../templates/footer.php'); ?>

</html>