<?php
    //i parakatw metabliti orizetai sto form pou kanw echo sto orderForm.inc.php
    if (isset($_POST['checkout'])) {
        $q = "SELECT `menuID` FROM `orders` WHERE `customerID` = '" . $_SESSION['userID'] . "'";
        $qRun = mysqli_query($conn, $q);
        if (mysqli_num_rows($qRun) == 0) {
            echo 'You have forgotten ordering :)';
        } else {
            //Tha epitrepsw se opoion dipote na kanei order?
            //eee, siga. Eprepe apo prin na to checkarw
            //Tha mporousa na exw Foreign key to Reservation ID ston pinaka Orders
            //An zitithei, to kanoume, EZ.
            $counter = 0;
            while ($resultID = mysqli_fetch_row($qRun)) {
                if ($counter == 0) {
                    $sqlWhereCondition = '`id` = ' . $resultID[0];
                } else {
                    $sqlWhereCondition = $sqlWhereCondition . ' || `id` = ' . $resultID[0];
                }
                $counter++;
            }
            //profanws, den epitrepw na exei order gia 2o reservation.
            //Prepei na plirwsei to Order sto 1o reservation, kai meta an thelei kanei order sto 2o.
            $qCost = "SELECT `price` FROM `menu` WHERE $sqlWhereCondition";
            //^- epeidi den einai Indexed to price, thymizw oti to "mysqli_numrows" tha epestrefe BOOLEAN, 
            //giati to xazo phpmyadmin epistrefei minima "Den exete unique key identifier sto query sas
            //Den me epireazei edw fusika, afou den xreisimopoiw autin tin entoli
            //PROSOXI, epitides den ebala mono autaki sto $sqlWhereCondition, gt ta periexei ola mesa.
            $qCostRun = mysqli_query($conn, $qCost);
            //Den xriazete na checkarw mysqli_num_rows, afou mpainw edw mono an !=0 to arxiko etwrotima
            $cost = 0;
            while ($resultCost = mysqli_fetch_row($qCostRun)) {
                $cost += $resultCost[0];
            }
            echo '<br>Cost is: '.$cost.'<br>Thank you.';
            //An exei kanei reservation kai patisei Checkout, tha sbisw to Reservation.
            $qLast = "SELECT `id` FROM `reservation` WHERE `customerID`='" . $_SESSION['userID'] . "'";
            $qLastRun = mysqli_query($conn, $qLast);
            if (mysqli_num_rows($qLastRun) > 0) {
                $qAtLast = "DELETE FROM `reservation` WHERE `customerID`='" . $_SESSION['userID'] . "'";
                $qAtLastRun = mysqli_query($conn, $qAtLast);
            } else {
                echo '<br>You have ordered without Reservation, but we allow it. :)';
            }
            //Thewrw oti PLIRWSE tin stigmi pou patise Checkout.
            //den upologizei diplotypa me tin ulopoihsh mou...
            //Tha to diorthwsw, bazontas Column: Quantity sto orders kai orizontas to analoga
            //Efoson ekane order, tha sbisw to Reservation toy??? Afou mporei na min exei... FIX
            //Tha sbisw tis egrafes tou order omws, gt mias kai plirwse den tis xriazome
            $qDeleteOrder = "DELETE FROM `orders` WHERE `customerID`='" . $_SESSION['userID'] . "'";
            $qDeleteRun = mysqli_query($conn, $qDeleteOrder);
            //Sbistike apo to orders pinaka, an deis. Teleia.
        }
    }
?>