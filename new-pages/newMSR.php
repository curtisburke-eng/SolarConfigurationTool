<?php 
    
    $temp_range = '';
    $lifting_type = '';
    $aux_package = '';
    $msu_notes = '';

    $errors = array('temp_range' => '','lifting_type' => '','aux_package' => '','msu_notes' => '');
    
    if(isset($_POST['submit'])){

        // Check & Validate Temp Range
        if(empty($_POST['temp_range'])) {
            //$errors['temp_range'] = 'Temperature Range is required. <br />';
        } else {
            $temp_range = $_POST['temp_range'];
            if(!preg_match('/^\b[0-9\-]+\b$/', $temp_range)) {
                $errors['temp_range'] =  'Only digits (with optional dash) (no letters or special characters). <br />';
            }
        }
 
        // Check & Validate Lifting Type
        if(!isset($_POST['forked_check']) && !isset($_POST['crane_check'])) {
            $errors['lifting_type'] = 'Lifting Type selection is required. <br />';
        } elseif(isset($_POST['forked_check']) && isset($_POST['crane_check'])) {
            $lifting_type = 'forked, craned';
        } elseif(isset($_POST['forked_check']) && !isset($_POST['crane_check'])) {
            $lifting_type = 'forked';
        } elseif(!isset($_POST['forked_check']) && isset($_POST['crane_check'])) {
            $lifting_type = 'craned';
        }
        $_POST['lifting_type'] = $lifting_type;
                
        // Check & Validate aux_package 
        if(empty($_POST['aux_package'])) {
            //$errors['aux_package'] = 'Auxiliary Package is required. <br />';
        } else {
            $aux_package = $_POST['aux_package'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $aux_package)) {
                $errors['aux_package'] =  'Comma separated list (no special characters). <br />';
            }
        }

        // Check & Validate Notes
        if(empty($_POST['msu_notes'])) {
            //$errors['msu_notes'] = 'Notes are required. <br />';
        } else {
            $msu_notes = $_POST['msu_notes'];
            if(!preg_match('/^\b[a-zA-Z0-9\,\s]+\b$/', $msu_notes)) {
                $errors['msu_notes'] =  'Allowed: letters, numbers, spaces, commas. <br /> Cannot end with a comma or space.';
            }
        }

        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
            
        } else { // No errors in array

            // Add to database
            include('../addToDB/addMSRToDB.php');

            // Redirect to Solar config page
            header('Location: ../new-pages/newSolar.php');

        }

    }
?>


<!DOCTYPE html>
<html>

<?php include('../templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Mobile Solar Unit Configuration</h4>
    <form class="white" action="newMSR.php" method="POST">
        
        <div class="input-field">
            <p>Lifting Type:</p>
            <p> 
                <label>
                    <input type="checkbox" class="filled-in" name="forked_check" value="your value" <?php if(isset($_POST['forked_check'])) echo "checked='checked'"; ?>  >
                    <span>Forked</span>
                </label>        
            </p>
            <p> 
                <label>
                    <input type="checkbox" class="filled-in" name="crane_check" value="your value" <?php if(isset($_POST['crane_check'])) echo "checked='checked'"; ?>  >
                    <span>Crane Lifted</span>
                </label>        
            </p>        
            <div class="red-text"><?php echo $errors['lifting_type']; ?></div>
        </div>

        <label>Temperature Range (&deg;F): (optional)</label>
        <input type="text" name="temp_range" value="<?php echo htmlspecialchars($temp_range); ?>">
        <div class="red-text"><?php echo $errors['temp_range']; ?></div>

        <label>Auxiliary Package: (Toolbox, Light Tower, Surveillance Tower, etc.) (optional)</label>
        <input type="text" name="aux_package" value="<?php echo htmlspecialchars($aux_package); ?>">
        <div class="red-text"><?php echo $errors['aux_package']; ?></div>

        <label>Notes: (optional)</label>
        <input type="text" name="msu_notes" value="<?php echo htmlspecialchars($msu_notes); ?>"> 
        <div class="red-text"><?php echo $errors['msu_notes']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('../templates/footer.php'); ?>

</html>