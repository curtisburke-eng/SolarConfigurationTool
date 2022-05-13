<?php 
    // Conect to the database
    include('config/db_connect.php');
    
    $phone = '';
    $unit_config = '';

    $errors = array('phone' => '', 'unit_config' => '');
    
    if(isset($_POST['submit'])){

        // Check & Validate Device Name
        if(empty($_POST['phone'])) {
            $errors['phone'] = 'A Phone Number is required. <br />';
        } else {
            $phone = $_POST['phone'];
            if(!preg_match('/^[0-9]{10}$/', $phone)) {
                $errors['phone'] =  'Phone number must be a only digits, 10-digits long. <br />';
            }
        }

        // Check & Validate Device Name
        if(empty($_POST['unit_config'])) {
            $errors['unit_config'] = 'A Unit selection is required. <br />';
        } else {
            $unit_config = $_POST['unit_config'];
            session_start();
            $_SESSION['unit_config']= $unit_config;
        }

        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
            
        } else { // No errors in array

            // Query database for id
            // GET CUSTOMER INFORMATION
            $sql = "SELECT cust_id FROM customers WHERE phone = '$phone'";
            // Make query & Get result
            $result  = mysqli_query($conn, $sql);
            // Fetch Resulting Rows as an array
            $cust_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $cust_id = $cust_id[0]['cust_id'];
            // Echo Results at the top for debugging
            //print_r($cust_id);
            echo 'cust_id: ' . $cust_id . '<br />';
            //echo 'phone: ' . $phone . '<br />';
            // Free resut from memory
            mysqli_free_result($result);

            
            mysqli_close($conn);

            session_start();
            $_SESSION['cust_id'] = $cust_id;

            //Redirect to list page
            if($unit_config == 'MSU') {
                header('Location: /list-pages/MSRList.php');
            } elseif($unit_config == 'shed') {
                header('Location: /list-pages/shedList.php'); 
            }

        }
        

    }
?>


<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Enter Customer Info</h4>
    <form class="white" action="existingCust.php" method="POST">
        <label>Phone Number: (10-digit)</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <div class="red-text"><?php echo $errors['phone']; ?></div>
        
        <label>Unit Selection:</label>
        <p>
            <label>
                <input name="unit_config" type="radio" value="MSU" <?php if($_POST['unit_config'] == 'MSU') echo "checked='checked'"; ?>/>
                <span>Mobile Solar Unit</span>
            </label>
        </p>
        <p>
            <label>
                <input name="unit_config" type="radio" value="shed" <?php if($_POST['unit_config'] == 'shed') echo "checked='checked'"; ?>/>
                <span>Solar Shed</span>
            </label>
        </p>
        <div class="red-text"><?php echo $errors['unit_config']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>