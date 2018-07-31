<?php
    $foodType = $_GET['foodType'];
    $q = "SELECT `id`, `name`,`price`,`details` FROM `menu` WHERE `menuID` = '$foodType'";
    $qRun = mysqli_query($conn, $q);
    if (mysqli_num_rows($qRun) == 0) {
        echo 'Please, don\'t play with the link.';
    } else {
        echo '
        <form action = "" method = "POST">
            <table border=1 frame=void cellpadding="7">
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Price (Euro)</th>
                <th>Description</th>
            </tr>';
        while ($qRunField = mysqli_fetch_row($qRun)) {//to name=id tou fagitou
            echo
            '<tr>
                 <td align=middle><input type="checkbox" name="' . $qRunField[0] . '"></td><td>' . $qRunField[1] . '</td> 
                 <td align=middle>' . $qRunField[2].'</td> 
                 <td>'.$qRunField[3] .'</td> 
            </tr>';
        }
        echo '</table>
            <input type = "submit" name = "orderCart" value = "Add to order" title = "Order">
            <input type = "submit" name = "checkout" value = "Checkout" title = "Procceed to Checkout">
        </form>';
        //$orderCartList = array();
        //To dilwnw mpas kai to xrisimopoihsw xwris if(isset). As eimai ligo tupikos. Ginotan kai xwris dilwsi.
        //Prepei na kanw ena Query na mou dwsei ta id tou Pasta/dessert menu klp
        //gia na dw an exoun setaristei, na ta prosthesw sto Order Cart.
        $q = "SELECT `id` FROM `menu` WHERE `menuID` = '$foodType'"; //I metabliti $foodtype exei dilwthei sto orderForm.inc.php
        $qRun = mysqli_query($conn, $q); //Thymizw oti i times xanontai meta to mysqli_fetch_row pou exw kanei sto orderForm.inc.php, opote ksana kanw query
        $orderCounter = 0;
        while ($resultID = mysqli_fetch_row($qRun)) {
            if (isset($_POST["$resultID[0]"])) {
                $orderCounter++;
                //$orderCartList[] = $resultID[0];
                //PROSOXI na balw alla onomata sta query, gt xrisimopoiw to panw query sto mysqli_fetch_row
                //an allaksw to query tha teleiwsw proora ;)
                $qAdd = "INSERT INTO `orders` (`orderID`, `menuID`, `CustomerID`) VALUES ('', '" . $resultID[0] . "','" . $_SESSION['userID'] . "')";
                $qRunAdd = mysqli_query($conn, $qAdd);
            }
        }
        if ($orderCounter != 0) {
            echo $orderCounter . ' items where added to the Order List.';
        }
    }

?>