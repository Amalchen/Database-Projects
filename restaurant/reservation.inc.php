<form action="" method="POST">
     <table>
          <tr>
               <td>Date:</td>
          <td>
               <select name="date">
               <?php
                    $year=date('Y'); //Gia to neo xrono tha kanw update ton kwdika
                    for($month=date('m'); $month<=date('m')+1; $month++){  //for gt mporw na epitrepw kratiseis mexri 1 mina meta. An ithela 2 mines meta +2, an mono auton to mina +0
                         if($month==date('m'))
                              $date=date('d');
                         else
                              $date=0;
                         $stop=0;
                         while(!$stop){
                              //Didn't consider a Leap Year. Once every 4 years(starting from 0), February got 29 days. Every 100th year isn't a leap year. Every 400th year, is a leap year.
                              if($date==31 || ($month==2 && $date==28) || (($month==4 || $month==6 || $month==9 || $month==11) && ($date==30)))
                                    $stop=1;
                              else{
                                    $date++;
                                    echo '<option>'.$year.'-'.$month.'-'.$date.'</option>';
                              }

                        }

                    }
               ?>
          </select>
          </td></tr>
          <tr>
               <td>Time:</td>
          <td>
               <select name="time">
               <?php
                    for($hour=12; $hour<22; $hour++)
                         for($minutes='00'; $minutes<=45; $minutes+=15)
                             echo '<option>'.$hour.':'.$minutes.':00</option>';
               ?>
               <option>22:00:00</option>
          </select>
          </td></tr>
          <tr>
               <td>Party:</td>
          <td>
               <select name="partyNumber">
                    <?php
                         for($temp=1;$temp<=16; $temp++)
                              echo '<option>'.$temp.'</option>';
                    ?>
          </select>
          </td></tr>
     </table>
     <input type="radio" name="smokerCheck" value="smokers"> Smoker<br>
     <input type="radio" name="smokerCheck" value="non-smokers"> Non-smoker<br>
     <input type="submit" name="submitReservation" value="Reserve">
</form>