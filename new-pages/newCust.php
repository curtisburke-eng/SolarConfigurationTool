<?php 

    session_unset();

    $cust_name = '';
    $cust_email = '';
    $cust_phone = '';
    $cust_location = '';
    $unit_config = '';

    $errors = array('cust_name' => '','cust_phone' => '','cust_email' => '','cust_location' => '','unit_config' => '');
    
    if(isset($_POST['submit'])){

        // Check & Validate Customer Name
        if(empty($_POST['cust_name'])) {
            $errors['cust_name'] = 'Name is required. <br />';
        } else {
            $cust_name = $_POST['cust_name'];
            if(!preg_match('/^\b[a-zA-Z\s]+\b$/', $cust_name)) {
                $errors['cust_name'] =  'Name must only letters and spaces (no numbers or special characters). <br />';
            }
        }
        
        // Check & Validate Phone Number
        if(empty($_POST['cust_phone'])) {
            $errors['cust_phone'] = 'Phone number is required. <br />';
        } else {
            $cust_phone = $_POST['cust_phone'];
            if(!preg_match('/^[0-9]{10}$/', $cust_phone)) {
                $errors['cust_phone'] =  'Phone number must be a only digits, 10-digits long. <br />';
            }
        }
        
        // Check & Validate Email 
        if(empty($_POST['cust_email'])) {
            //$errors['cust_email'] = 'Email is required. <br />';
        } else {
            $cust_email = $_POST['cust_email'];
            if(!preg_match('/^[\w\.]+@([\w-]+\.)+[\w-]{2,4}$/', $cust_email)) {
                $errors['cust_email'] =  'Must enter a vailid email address. <br />';
            }
        }

        // Check & Validate Location
        if(empty($_POST['cust_location'])) {
            //$errors['cust_location'] = 'Location is required. <br />';
        } else {
            $cust_location = $_POST['cust_location'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $cust_location)) {
                $errors['cust_location'] =  'Location must be a comma separated list with only letters & numbers (no special characters). <br />';
            }
        }

        // Check & Validate unit_config
        if(empty($_POST['unit_config'])) {
            $errors['unit_config'] = 'A Unit selection is required. <br />';
        } else {
            // Start a Session
            session_start();
            $unit_config = $_POST['unit_config'];
            $_SESSION['unit_config'] = $unit_config;
        }
        
        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
            
        } else { // No errors in array

            // Add to database
            include('../addToDB/addCustToDB.php');
            
            //Redirect to next page
            if($unit_config == 'MSU') {
                header('Location: ../new-pages/newMSR.php');
            } elseif($unit_config == 'shed') {
                header('Location: ../new-pages/newShed.php');
            }


        }

    }
?>


<!DOCTYPE html>
<html>

<?php include('../templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Customer Information</h4>
    <form class="white" action="newCust.php" method="POST">
        <label>Name:</label>
        <input type="text" name="cust_name" value="<?php echo htmlspecialchars($cust_name) ?>">
        <div class="red-text"><?php echo $errors['cust_name']; ?></div>

        <label>Phone Number: (10-digit)</label>
        <input type="text" name="cust_phone" value="<?php echo htmlspecialchars($cust_phone) ?>">
        <div class="red-text"><?php echo $errors['cust_phone']; ?></div>

        <label>Email: <br /> (optional)</label>
        <input type="text" name="cust_email" value="<?php echo htmlspecialchars($cust_email); ?>">
        <div class="red-text"><?php echo $errors['cust_email']; ?></div>

        <label>Location: (State, County) <br /> (optional)</label>
        <input type="text" name="cust_location" value="<?php echo htmlspecialchars($cust_location); ?>">
        <div class="red-text"><?php echo $errors['cust_location']; ?></div>

        <div class="input-field">

            <p>Unit Selection:</p>
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

        </div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('../templates/footer.php'); ?>

</html>