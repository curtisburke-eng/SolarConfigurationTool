<?php

    include('config/db_connect.php');

    session_start();
    $unit_config = $_SESSION['unit_config'];
    
    
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //CHECK IF id EXISTS
        $query = "SELECT EXISTS(SELECT * FROM configs WHERE config_id = '$id')";
        $result  = mysqli_query($conn, $query);
        // Fetch Resulting Rows as an array
        $config_exists = mysqli_fetch_all($result, MYSQLI_NUM);
        //print_r($config_exists);
        $config_exists = $config_exists[0][0];
        // Print Results (for debugging)
        //echo $config_exists;
        // Free resut from memory
        mysqli_free_result($result);

    }

    if(isset($_POST['back'])){
        //Redirect to list page
        if($unit_config == 'MSU') {
            header('Location: list-pages/MSRList.php');
        } elseif($unit_config == 'shed') {
            header('Location: list-pages/shedList.php'); 
        }
    }

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        //CHECK IF id EXISTS
        $query = "DELETE FROM configs WHERE config_id = '$id_to_delete'";
        $result  = mysqli_query($conn, $query);
        if($result) {
            //success
            //Redirect to list page
            if($unit_config == 'MSU') {
                header('Location: list-pages/MSRList.php');
            } elseif($unit_config == 'shed') {
                header('Location: list-pages/shedList.php'); 
            }
        } else {
            //failure
            echo 'DELETE query error: ' . mysqli_error($conn);
        }
        mysqli_free_result($result);
    }



?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <?php
        // If customer DOES NOT exist in db => add it
        if($config_exists){

    ?>


    <div class="container center">
        <div class="row center">
            <h4>Confirm Delete</h4>
        </div>
        <div class="row center">
            <h6>Are you sure you want to delete this configuration?</h6>
        </div>
        <!-- DELETE FORM -->
        <form action="confirmDelete.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $id;?>">
            <input type="submit" name="back" class="btn brand " value="BACK">
            <input type="submit" name="delete" class="btn brand " value="DELETE">           
        </form>
    </div>

    <?php
        }
        else {
    ?>
    
    <div class="container">
        <div class="row center">
            <h4>No Configuration exists with that id.</h4>
        </div>
        <div class="row center">
            <a class="btn brand" href="/">HOME</a>
        </div>
    </div>

    <?php
        }
    ?>

    

    <?php 
        mysqli_close($conn);
        include('templates/footer.php'); 
    ?>   

</html>