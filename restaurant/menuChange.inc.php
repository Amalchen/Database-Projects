<?php
          $q="SELECT `name` FROM `menu`";
          $qRun=mysqli_query($conn, $q);
          echo '<h3>Select an item to update</h3>
               <form action="" method="GET">
                    <select name="foodToBeUpdated">';
               while($qRunField = mysqli_fetch_row($qRun)){
                    echo '<option>'.$qRunField[0].'</option>';
               }
          echo
               '</select>
                    <input type="submit" name="submitFoodToBeUpdated" value="Select">
               </form>';
?>
