<?php 

    $dimensions = '';
    $doors = '';
    $windows = '';
    $insulation = '';
    $siding = '';
    $siding_color = '';
    $roof = '';
    $roof_color = '';
    $interior = '';
    $int_floor = '';
    $int_walls = '';
    $int_ceiling = '';
    $foundation = '';
    $lifting_type = '';
    $shed_notes = '';

    $errors = array('dimensions' => '','doors' => '','windows' => '','insulation' => '','siding' => '','siding_color' => '','roof' => '','roof_color' => '','interior' => '','int_floor' => '','int_walls' => '','int_ceiling' => '','foundation' => '','lifting_type' => '','shed_notes' => '');
    
    if(isset($_POST['submit'])){

        // Check & Validate Dimensions
        if(empty($_POST['dimensions'])) {
            $errors['dimensions'] = 'Dimensions are required. <br />';
        } else {
            $dimensions = $_POST['dimensions'];
            if(!preg_match('/^\b[0-9xX]+\b$/', $dimensions)) {
                $errors['dimensions'] =  'Allowed: Digits and x (no letters or special characters). <br /> Example: 8x12';
            }
        }
 
        // Check & Validate Doors
        if(empty($_POST['doors'])) {
            $errors['doors'] = 'Door selection is required. <br />';
        } else {
            $doors = $_POST['doors'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $doors)) {
                $errors['doors'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
         
        // Check & Validate windows
        if(empty($_POST['windows'])) {
            $errors['windows'] = 'Window selection is required. <br />';
        } else {
            $windows = $_POST['windows'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $windows)) {
                $errors['windows'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
         
        // Check & Validate Insulation
        if(empty($_POST['insulation'])) {
            $errors['insulation'] = 'Insulation Material selection is required. <br />';
        } else {
            $insulation = $_POST['insulation'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $insulation)) {
                $errors['insulation'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }

        // Check & Validate Siding
        if(empty($_POST['siding'])) {
            $errors['siding'] = 'Siding Material selection is required. <br />';
        } else {
            $siding = $_POST['siding'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $siding)) {
                $errors['siding'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate Siding Color
        if(empty($_POST['siding_color'])) {
            $errors['siding_color'] = 'Siding Color selection is required. <br />';
        } else {
            $siding_color = $_POST['siding_color'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $siding_color)) {
                $errors['siding_color'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate Roof
        if(empty($_POST['roof'])) {
            $errors['roof'] = 'Roof Material selection is required. <br />';
        } else {
            $roof = $_POST['roof'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $roof)) {
                $errors['roof'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate Roof Color
        if(empty($_POST['roof_color'])) {
            $errors['roof_color'] = 'Roof Color selection is required. <br />';
        } else {
            $roof_color = $_POST['roof_color'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $roof_color)) {
                $errors['roof_color'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }

        // Check & Validate Interior
        if(empty($_POST['interior'])) {
            $errors['interior'] = 'Interior finish level is required. <br />';
        } else {
            $interior = $_POST['interior'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $interior)) {
                $errors['interior'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }

        // Check & Validate Interior Floor
        if(empty($_POST['int_floor'])) {
            //$errors['int_floor'] = 'Interior floor selection is required. <br />';
        } else {
            $int_floor = $_POST['int_floor'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $int_floor)) {
                $errors['int_floor'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate Interior Walls
        if(empty($_POST['int_walls'])) {
            //$errors['int_walls'] = 'Interior wall finishing material selection is required. <br />';
        } else {
            $int_walls = $_POST['int_walls'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $int_walls)) {
                $errors['int_walls'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }
        
        // Check & Validate Interior Ceiling
        if(empty($_POST['int_ceiling'])) {
            //$errors['int_ceiling'] = 'Interior ceiling finishing material selection is required. <br />';
        } else {
            $int_ceiling = $_POST['int_ceiling'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $int_ceiling)) {
                $errors['int_ceiling'] =  'Comma separated list with letters or numbers (no special characters). <br />';
            }
        }

        // Check & Validate Foundation
        if(empty($_POST['foundation'])) {
            $errors['foundation'] = 'Foundation selection is required. <br />';
        } else {
            $foundation = $_POST['foundation'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $foundation)) {
                $errors['foundation'] =  'Comma separated list with letters or numbers (no special characters). <br />';
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


        // Check & Validate Notes
        if(empty($_POST['shed_notes'])) {
            //$errors['shed_notes'] = 'Notes are required. <br />';
        } else {
            $shed_notes = $_POST['shed_notes'];
            if(!preg_match('/^\b[a-zA-Z0-9\,\s]+\b$/', $shed_notes)) {
                $errors['shed_notes'] =  'Allowed: letters, numbers, spaces, commas. <br /> Cannot end with a comma or space.';
            }
        }

        // Check if any errors exsits
        if(array_filter($errors)) {  //IF no errors inside $errors will return false
            // Errors in the array
            
        } else { // No errors in array

            // Add to database
            include('../addToDB/addShedToDB.php');
            // Redirect to addSolar page
            header('Location: ../new-pages/newSolar.php');
        }

    }
?>


<!DOCTYPE html>
<html>

<?php include('../templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Shed Configuration</h4>
    <form class="white" action="newShed.php" method="POST">
        
        <label>Exterior Dimensions (Feet):</label>
        <input type="text" name="dimensions" value="<?php echo htmlspecialchars($dimensions); ?>">
        <div class="red-text"><?php echo $errors['dimensions']; ?></div>

        <label>Door Selection:</label>
        <input type="text" name="doors" value="<?php echo htmlspecialchars($doors); ?>">
        <div class="red-text"><?php echo $errors['doors']; ?></div>

        <label>Window Selection:</label>
        <input type="text" name="windows" value="<?php echo htmlspecialchars($windows); ?>">
        <div class="red-text"><?php echo $errors['windows']; ?></div>

        <label>Insulation Type:</label>
        <input type="text" name="insulation" value="<?php echo htmlspecialchars($insulation); ?>">
        <div class="red-text"><?php echo $errors['insulation']; ?></div>

        <label>Siding Type:</label>
        <input type="text" name="siding" value="<?php echo htmlspecialchars($siding); ?>">
        <div class="red-text"><?php echo $errors['siding']; ?></div>

        <label>Siding Color:</label>
        <input type="text" name="siding_color" value="<?php echo htmlspecialchars($siding_color); ?>">
        <div class="red-text"><?php echo $errors['siding_color']; ?></div>

        <label>Roof Type:</label>
        <input type="text" name="roof" value="<?php echo htmlspecialchars($roof); ?>">
        <div class="red-text"><?php echo $errors['roof']; ?></div>

        <label>Roof Color:</label>
        <input type="text" name="roof_color" value="<?php echo htmlspecialchars($roof_color); ?>">
        <div class="red-text"><?php echo $errors['roof_color']; ?></div>

        <label>Interior Finish Level (fully, partially, unfinished):</label>
        <input type="text" name="interior" value="<?php echo htmlspecialchars($interior); ?>">
        <div class="red-text"><?php echo $errors['interior']; ?></div>

        <label>Interior Floor Selection (if applicaple):</label>
        <input type="text" name="int_floor" value="<?php echo htmlspecialchars($int_floor); ?>">
        <div class="red-text"><?php echo $errors['int_floor']; ?></div>

        <label>Interior Walls Selection (if applicaple):</label>
        <input type="text" name="int_walls" value="<?php echo htmlspecialchars($int_walls); ?>">
        <div class="red-text"><?php echo $errors['int_walls']; ?></div>

        <label>Interior Ceiliing Selection (if applicaple):</label>
        <input type="text" name="int_ceiling" value="<?php echo htmlspecialchars($int_ceiling); ?>">
        <div class="red-text"><?php echo $errors['int_ceiling']; ?></div>

        <label>Mounting Surface/Foundation: (concrete, dirt, sand, etc.)</label>
        <input type="text" name="foundation" value="<?php echo htmlspecialchars($foundation); ?>">
        <div class="red-text"><?php echo $errors['foundation']; ?></div>
       
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
        
        <label>Notes: (optional)</label>
        <input type="text" name="shed_notes" value="<?php echo htmlspecialchars($shed_notes); ?>">
        <div class="red-text"><?php echo $errors['shed_notes']; ?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0"> 
        </div>
    </form>
</section>

<?php include('../templates/footer.php'); ?>

</html>