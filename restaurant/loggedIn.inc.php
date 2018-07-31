<form action= "<?php echo $currentFile; ?>" method="GET">
     <input type="submit" name="book" value="Book Table" title="Book a Table">
     <input type="submit" name="menu" value="Menu" title="View Menus">
     <input type="submit" name="order" value="Order" title="Make an Order">
</form>

<?php
     $_SESSION['orderHitCounter']=0;
     if(isset($_GET['book']))
          include 'reservation.inc.php';
     else if(isset($_GET['menu']))
          include 'menu.inc.php';
     else if(isset($_GET['order']))
          include 'order.inc.php';


     //Reservation
     if(isset($_POST['submitReservation'])){
          $date = htmlentities($_POST['date']);
          $time = htmlentities($_POST['time']);
          $partyNumber = htmlentities($_POST['partyNumber']);
          $smokerCheck = htmlentities($_POST['smokerCheck']);
          if(!empty($date) && !empty($time) && !empty($partyNumber) && !empty($smokerCheck)){
               if($partyNumber<=4)
                    $tableNeeded=4;
               else if($partyNumber<=6)
                    $tableNeeded=6;
               else
                    $tableNeeded=1; //Sumboliki timi, metepeita sunthiki if gia eksetasi enwsis trapeziou
               if($tableNeeded != 1){
                    $q="SELECT `tableNumber`, `customerID`, `id` FROM `reservation` WHERE `date`='$date' AND `time`='$time'";
                    //to `id` to pairnw anagkastika. Alliws epeidi to SELECT den periexei Primary Key, an kai to query douleuei swsta to phpmyadmin mou epistrefei ena Warning oti den exw primary key sto query
                    //auto to warning katastrefei to mysqli_num_rows pou anti na mou epistrepsei rows, mou epistrefei BOOLEAN, kati pou den kanei sta SELECT.
                    //Ti na pei kaneis, problimata pou exei to phpmyadmin...
                    //Parakatw kanw elegxw an exei kanei idi kratisi o xristis tin idia wra, na min ton afisw na diplokratisei trapezi.
                    $qRun=mysqli_query($conn, $q);
                    if(mysqli_num_rows($qRun)!=0){
                         $FLAG=1;
                         while(($result = mysqli_fetch_row($qRun)) && $FLAG)
                              //PROSOXI stin parenthesi. I proteraiothta me epaikse prin tin balw...
                              if($_SESSION['userID'] == $result[1]){
                                  echo 'You already have a reservation at this particular time.';
                                  //mysqli_free_result($result); //kanw free, mpas kai mperdepsei o kwdikas parakatw
                                  $FLAG=0;
                              }

                         if($FLAG){
                              //An mpw edw den exei kanei diplokratisi, ola kala.
                              $counter=0;
                              //Den gnwrisw POSA einai ta trapezia pou exoun Kratithei gia tin anwthen imerominia/wra
                              //Ara, den gnwrisw POSA trapezia prepei na grapsw stin sql na einai != mpla mpla
                              //To lunw eksupna me ena string.
                              //Den eleksa an einai beltistos o tropos dimiourgias tou string
                              $q="SELECT `tableNumber` FROM `reservation` WHERE `date`='$date' AND `time`='$time'";
                              $qRun=mysqli_query($conn, $q);
                              //Ksanaetreksa to idio query (sxedon) gt gia kapoio logo xanetai alliws. Logika eite apo to mysqli_fetch_row eite apo to mysqli_free_result($result).
                              while($result = mysqli_fetch_row($qRun)){
                                   if($counter == 0)
                                        $sqlWhereCondition='`tableNumber` != '.$result[0];
                                   else
                                        $sqlWhereCondition = $sqlWhereCondition.' && `tableNumber` != '.$result[0];

                                   $counter++;
                              }
                              $q="SELECT `tableNumber` FROM `tables` WHERE $sqlWhereCondition AND `seat`='$tableNeeded'";
                              //PROSOXI, epitides den ebala mono autaki sto $sqlWhereCondition, gt ta periexei ola mesa.
                              //Me ton tropo pou to ulopoiw an einai 4 atoma kai exw MONO trapezia gia 6 atoma, den tha tous to dwsw. Epilogi mou teleiws. Mporw profanws na allaksw to `seat`='$tableNeeded' me `seat`='$partyNumber'
                              $qRun=mysqli_query($conn, $q);
                              if(mysqli_num_rows($qRun)==0)
                                   echo 'Sorry, we don\'t have a table';
                              else{
                                   $result=mysqli_fetch_row($qRun);
                                   //PROSOXI sto $_SESSION thelei ".  ." alliws bgazei error
                                   $qReserveString ="INSERT INTO `reservation` (`id`, `date`, `time`, `partyNumber`, `tableNumber`, `customerID`) VALUES('', '$date', '$time', '$partyNumber', '$result[0]', '".$_SESSION['userID']."')";
                                   $qReserveRun=mysqli_query($conn, $qReserveString);
                                   $reservationCongratsString='Reservation successful.<br>Thanks & have a wonderful meal.';
                             }
                         }
                    }
                    else{
                         //Einai adeio to magazi; Apla pramata
                         $qReserveString = "SELECT `tableNumber` FROM `tables` WHERE `seat`='$tableNeeded'";
                         $qReserveRun=mysqli_query($conn, $qReserveString);
                         $result=mysqli_fetch_row($qReserveRun);
                         //Tha tou balw to 1o trapezi, afou h diataksi trapeziwn den exei simasia
                         //PROSOXI sto $_SESSION thelei ".  ." alliws bgazei error
                         $qReserveString ="INSERT INTO `reservation` (`id`, `date`, `time`, `partyNumber`, `tableNumber`, `customerID`) VALUES('', '$date', '$time', '$partyNumber', '$result[0]', '".$_SESSION['userID']."')";
                         $qReserveRun=mysqli_query($conn, $qReserveString);
                         $reservationCongratsString='Reservation successful.<br>Thanks & have a wonderful meal.';
                     }
               }
               else if($tableNeeded == 1){
                    $tableNeeded=$partyNumber;
                    //Eksetasi enwsis trapeziwn
                    //O kwdikas einai paromoios me tis prohgoumenes periptwseis
                    //alla den ta ekana mazi; nomizw de ginete kiolas. Kalitera xwrista
                    $q="SELECT `customerID` FROM `reservation` WHERE `date`='$date' AND `time`='$time'";
                    $qRun=mysqli_query($conn, $q);
                    //Den me endiaferei an einai adeio h an exei kosmo to magazi. H enwsi einai enwsi.
                    //elegxw gia diplokrati OPWS prin. Copy paste... Kako auto...
                    $FLAG=1;
                    while(($result = mysqli_fetch_row($qRun)) && $FLAG)
                         if($_SESSION['userID'] == $result[0]){
                             echo 'You already have a reservation at this particular time.';
                             $FLAG=0;
                         }
                    if($FLAG){
                         //to id to pairnw mono kai mono gia to num_rows
                         $q="SELECT `tableNumber`,`id` FROM `reservation` WHERE `date`='$date' AND `time`='$time'";
                         $qRun=mysqli_query($conn, $q);
                         $q2="SELECT `tableNumber` FROM `tables`";
                         $qRun2=mysqli_query($conn, $q2);
                         //an oi kratiseis exoun idio plithos me ta trapezia, eimai full profanws
                         //eite an exoun 1 diafora, den ginetai enwsi.
                         if(mysqli_num_rows($qRun)!=0 ){
                              if((mysqli_num_rows($qRun2)-mysqli_num_rows($qRun)<=1))
                                   echo 'Sorry, we are full';
                              else{
                                   $counter=0;
                                   while($resultKratiseis = mysqli_fetch_row($qRun)){
                                        if($counter == 0)
                                             $sqliCond='`tableNumber` != '.$resultKratiseis[0];
                                        else
                                             $sqliCond = $sqliCond.' && `tableNumber` != '.$resultKratiseis[0];

                                        $counter++;
                                   }
                                   $q5="SELECT `tableNumber`,`seat` FROM `tables` WHERE $sqliCond";
                                   $q5Run=mysqli_query($conn, $q5);
                                   //twra exw OLA ta DIATHESIMA trapezia
                                   $counter=0;
                                   $FLAG2=1;
                                   while(($result5=mysqli_fetch_row($q5Run)) && $FLAG2){
                                        //PROSOXI NA BALW PARENTHESI
                                        if($counter==0){
                                             $temp=$result5[1];
                                             $sqliCond2='VALUES (\'\', \''.$date.'\', \''.$time.'\', '.$tableNeeded.', '.$result5[0].', '.$_SESSION['userID'].')';
                                        }
                                        else{

                                             if(($temp+$result5[1]-2)>= $tableNeeded){
                                                  $temp=$temp+$result5[1]-2;
                                                  $FLAG2=0;
                                             }
                                             else
                                                  $temp=$temp+$result5[1]-2;
                                                  $sqliCond2=$sqliCond2.', (\'\', \''.$date.'\', \''.$time.'\', '.$tableNeeded.', '.$result5[0].', '.$_SESSION['userID'].')';
                                        }
                                        $counter++;
                                   }
                                   if($temp>=$tableNeeded){
                                        $reservationCongratsString='Reservation successful.<br>Thanks & have a wonderful meal.';
                                        $qInsert="INSERT INTO `reservation` (`id`, `date`, `time`, `partyNumber`, `tableNumber`, `customerID`) $sqliCond2";
                                        $qInsertRun=mysqli_query($conn, $qInsert);
                                   }
                                   else
                                        echo 'Sorry, cannot reserve for that many people :(';
                              }

                         }
                         else{
                              //Adeio magazi, EASY!
                              //prepei na balw alliws to string.
                              $q5="SELECT `tableNumber`,`seat` FROM `tables`";
                              $q5Run=mysqli_query($conn, $q5);
                              //OLA ta trapezia einai diathesima
                              //Apla copy paste o kwdikas
                              $counter=0;
                              $FLAG2=1;
                              while(($result5=mysqli_fetch_row($q5Run)) && $FLAG2){
                                   //PROSOXI NA BALW PARENTHESI
                                   if($counter==0){
                                        $temp=$result5[1];
                                        $sqliCond2='VALUES (\'\', \''.$date.'\', \''.$time.'\', '.$tableNeeded.', '.$result5[0].', '.$_SESSION['userID'].')';
                                   }
                                   else{

                                        if(($temp+$result5[1]-2)>= $tableNeeded){
                                             $temp=$temp+$result5[1]-2;
                                             $FLAG2=0;
                                        }
                                        else
                                             $temp=$temp+$result5[1]-2;
                                             $sqliCond2=$sqliCond2.', (\'\', \''.$date.'\', \''.$time.'\', '.$tableNeeded.', '.$result5[0].', '.$_SESSION['userID'].')';
                                   }
                                   $counter++;
                              }
                              if($temp>=$tableNeeded){
                                   //echo $sqliCond2;
                                   $reservationCongratsString='Reservation successful.<br>Thanks & have a wonderful meal.';
                                   //echo '<br>TEMP ='.$temp.' asd';
                                   $qInsert="INSERT INTO `reservation` (`id`, `date`, `time`, `partyNumber`, `tableNumber`, `customerID`) $sqliCond2";
                                   $qInsertRun=mysqli_query($conn, $qInsert);
                              }
                              else
                                   echo 'Sorry, cannot reserve for that many people :(';

                         }

                    }
               }
          }
          else
               echo 'We need to know date, time, and Party number to make a reservation.<br>Don\'t forget to choose a smoker or non-smoker table.';
     }
     if(!empty($reservationCongratsString))
          echo $reservationCongratsString;

     //Telos me ta Reservation
     //Arxi Menu
     if(isset($_GET['submitFoodType'])){

          include 'menu.inc.php';
          $foodType=$_GET['foodType'];
          $q="SELECT `name`,`price`,`details` FROM `menu` WHERE `menuID`='$foodType'";
          $qRun=mysqli_query($conn, $q);
          if(mysqli_num_rows($qRun)==0)
               echo 'Please, don\'t play with the link.';
          else{
               echo '<h3>Order while Booking = Eat on arrival.</h3>';
               echo '<table border=1 frame=void cellpadding="7">
               <tr>
                    <th>Name</th>
                    <th>Price (Euro)</th>
                    <th>Description</th>
               </tr>';
               while($qRunField = mysqli_fetch_row($qRun)){
                    echo
                    '<tr>
                         <td>'.$qRunField[0].'</td>'.
                         '<td align=middle>'.$qRunField[1].'</td>'.
                         '<td>'.$qRunField[2].'</td>'.
                    '</tr>';
               }
               echo '</table>';
          }
     }
     //Telos me to Menu
     //Arxi Order
     if(isset($_GET['orderFoodType'])){
          include 'order.inc.php';
          include 'orderForm.inc.php';
          include 'orderPay.inc.php';
          echo '<h3>Every time you click "add to order" the order is done.<br>Click "Order" again to continue ordering.</h3>';
     }
     //Telos Order

?>