<?php
    session_start();
    session_unset();
?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col s12 md6 l6">
                <div class="card">
                    <div class="card-image">
                        <img src="img/ryobi-devs-cropped-resized.jpg">
                        <a href="new-pages/newDev.php" class="halfway-fab btn-floating btn-large brand">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">Devices</span>

                    </div>

                    <div class="card-action right-align">
                    <a class="brand-text right-align" href="list-pages/devList.php">List</a>
                    </div>
                </div>
            </div>

            <div class="col s12 md6 l6">
                <div class="card">
                    <div class="card-image">
                        <img src="img/shed-resized.JPG" alt="">
                        <a href="new-pages/newCust.php" class="halfway-fab btn-floating btn-large brand">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                    <div class="card-content">
                        <span class="card-title">Configurations</span>

                    </div>
                    <div class="card-action right-align">
                    <a class="brand-text" href="existingCust.php" >Existing</a>
                    </div>
                </div>
            </div>

        </div>


    </div>


  <?php include('templates/footer.php'); ?>

</html>
