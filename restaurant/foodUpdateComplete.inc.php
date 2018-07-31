<?php
    if (isset($_POST['SubmitUpdate'])) {
        if (isset($_POST['newName']) && isset($_POST['newPrice']) && isset($_POST['newDetails'])) {
            $newName = $_POST['newName'];
            $newPrice = $_POST['newPrice'];
            $newDetails = $_POST['newDetails'];
            if (!empty($newName) && !empty($newPrice) && !empty($newDetails)) {
                $q = "UPDATE `menu` SET `name`='$newName', `details`='$newDetails', `price` = '$newPrice' WHERE `id` = $result[2]";
                $qRun = mysqli_query($conn, $q);
                if ($qRun) { //to UPDATE epistrefei BOOLEAN, ara to bazw apeutheias mesa.
                    echo '<h3>Great, Item updated.</h3>';
                } else {
                    echo 'Uuh, some error occured. Please try again or contact programmer.';
                }
            } else {
                echo 'Please fill in all the fields.';
            }
        }
    }
?>