<?php
    // connect to the database
    include('../config/db_connect.php');

    // Write query for all devices
    $sql = 'SELECT device_name, device_desc, amps, watts FROM loads ORDER BY device_name';
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
        <h4 class="center">Master Device List</h4>

    </section>

    <div class="contrainer">
        <div class="row">
            <div class="col s12 md12 l12">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <div class="row">
                            <h5 class="col s3 md3 l3"> Device</h5>
                            <h5 class="col s5 md5 l5"> Description</h5>
                            <h5 class="col s2 md2 l2"> Load (A)</h5>
                            <h5 class="col s2 md2 l2"> Power (W)</h5>
                        </div>
                        
                        <?php  foreach($rows as $row) { ?>    

                            <div class="row">
                                <div class="col s3 md3 l3"> <?php echo htmlspecialchars($row['device_name']); ?> </div>
                                <div class="col s5 md5 l5"> <?php echo htmlspecialchars($row['device_desc']); ?> </div>
                                <div class="col s2 md2 l2"> <?php echo htmlspecialchars($row['amps']); ?> </div>
                                <div class="col s2 md2 l2"> <?php echo htmlspecialchars($row['watts']); ?> </div>
                            </div>
                
                        <?php } ?>
                        
    
                    </div>
                        
                    <div class="card-action right-align">
                        <a class="brand-text" href="../new-pages/newDev.php">New Device</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php include('../templates/footer.php'); ?>

</html>
