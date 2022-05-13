<?php 
    
    $dev_name = '';
    $dev_desc = '';
    $amps = '';
    $watts = '';

    $errors = array('dev_name' => '','dev_desc' => '','amps' => '','watts' => '');
    
    if(isset($_POST['submit'])){

        // Check & Validate Device Name
        if(empty($_POST['dev_name'])) {
            $errors['dev_name'] = 'A Device Name is required. <br />';
        } else {
            $dev_name = $_POST['dev_name'];
            if(!preg_match('/^\b[0-9a-zA-Z\s\/\-\.\,]+\b$/', $dev_name)) {
                $errors['dev_name'] =  'Device Name must be only letters, numbers, or allowed special characters (forward slash, hyphen, period, comma) <br /> Cannot end with a space or special character.';
            }
        }
        
        // Check & Validate Device Desctription
        if(empty($_POST['dev_desc'])) {
            //$errors['dev_desc'] = 'A Device Desctription is required. <br />';
        } else {
            $dev_desc = $_POST['dev_desc'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $dev_desc)) {
                $errors['dev_desc'] =  'Device Description must be a comma separated list with only letters & numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate amps
        if(empty($_POST['amps']) && empty($_POST['watts'])) {
            $errors['amps'] = 'Either Load (in Amps) or Load (in Watts) is required. <br />';
            $errors['watts'] = 'Either Load (in Amps) or Load (in Watts) is required. <br />';
        } else {
            $amps = $_POST['amps'];
            $watts = $_POST['watts'];
            if(!empty($_POST['amps'])) {
                if(!preg_match('/^\b[0-9\.]+\b$/', $amps)) {
                    $errors['amps'] = 'Load (in Amps) must be a single entry of only numbers. <br />';
                }
            }
            if(!empty($_POST['watts'])) {
                if(!preg_match('/^\b[0-9]+\b$/', $watts)) {
                    $errors['watts'] = 'Load (in Watts) must be a single entry of only numbers. <br />';
                }
            }
        }

        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
        } else { // No errors in array

            // Add to database
            include('../addToDB/addDevToDB.php');
            
            // Redirect 
            header('Location: ../list-pages/devList.php');
        }

    }
?>


<!DOCTYPE html>
<html>

<?php include('../templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add a Device</h4>
    <form class="white" action="newDev.php" method="POST">
        <label>Device Name:</label>
        <input type="text" name="dev_name" value="<?php echo htmlspecialchars($dev_name) ?>">
        <div class="red-text"><?php echo $errors['dev_name']; ?></div>

        <label>Device Desctription: (Brand, Size, Color, etc.) <br /> (optional)</label>
        <input type="text" name="dev_desc" value="<?php echo htmlspecialchars($dev_desc) ?>">
        <div class="red-text"><?php echo $errors['dev_desc']; ?></div>

        <label>Load (Amps): <br /> (optional)</label>
        <input type="text" name="amps" value="<?php echo htmlspecialchars($amps); ?>">
        <div class="red-text"><?php echo $errors['amps']; ?></div>

        <label>Load (Watts): <br /> (optional)</label>
        <input type="text" name="watts" value="<?php echo htmlspecialchars($watts); ?>">
        <div class="red-text"><?php echo $errors['watts']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('../templates/footer.php'); ?>

</html>