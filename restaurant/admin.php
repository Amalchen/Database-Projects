<form action= "<?php echo $currentFile ?>" method="GET">
     <input type="submit" name="menuChange" value="Change Menu" title="Add or Remove from Menu">
     <input type="submit" name="tableChange" value="Tables" title="Add/Remove tables">

</form>


<?php
     if(isset($_GET['menuChange'])){
          include 'menuAdmin.inc.php';
     }
     else if(isset($_GET['tableChange'])){
          include 'tableMenu.inc.php';
     }

     if(isset($_POST['menuAdd'])){
          include 'menuAdmin.inc.php';
          include 'menuAdd.inc.php';
          echo '<h3>If you want to add to Menu Of The Day specify MenuId: specialty</h3>';
     }
     else if(isset($_POST['menuRemove'])){
          include 'menuAdmin.inc.php';
          include 'menuRemove.inc.php';
          echo '<h3>Remember to remove specialty menu.</h3>';
     }
     else if(isset($_POST['menuChange'])){
          include 'menuAdmin.inc.php';
          include 'menuChange.inc.php';
     }

     if(isset($_POST['submitAdd'])){

          if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['menuID'])){
               $name=htmlentities($_POST['name']);
               $price=htmlentities($_POST['price']);
               $menuID=htmlentities($_POST['menuID']);
               //echo '<br>name= '.$name.'<br>price= '.$price.'<br>menuId= '.$menuID.'<br>';
               if(!empty($name) && !empty($price) && !empty($menuID)){
                    $q="INSERT INTO `menu` (`id`, `name`, `price`, `menuId`) VALUES ('', '$name','$price','$menuID')";
                    if($qRun = mysqli_query($conn, $q))
                              echo '<br>Successfully added '.$name.' to '.$menuID.' menu, with a cost of: '.$price.' Euros.<br>';
                     else
                         echo 'Unexpected error. Please contact programmer.';
               }
               else
                    echo 'Please fill in all the fields';
          }
     }
     else if(isset($_POST['submitRemove'])){
          if(isset($_POST['nameRemove'])){
               $nameRemove=htmlentities($_POST['nameRemove']);
               if(!empty($nameRemove)){
                    $q="SELECT `id`,`name`,`price`,`menuID` FROM `menu` WHERE `name`='".mysqli_real_escape_string($conn, $nameRemove)."'";
                    if($qRun = mysqli_query($conn, $q)){
                         $qNumRows = mysqli_num_rows($qRun);
                         if($qNumRows == 0){
                              echo 'Such item does NOT exist in our Menu.';
                         }
                         else if($qNumRows == 1){
                              $qRunField=mysqli_fetch_row($qRun);
                              $idRemoval=$qRunField[0];
                              $nameRemoval=$qRunField[1];
                              $cost=$qRunField[2];
                              $menuIDRemoval=$qRunField[3];
                              $_SESSION['idRemoval']=$idRemoval;
                              echo 'You are about to delete '. $nameRemoval.' from the '.$menuIDRemoval.' menu. Are you sure?';
                              include 'confirm.inc.php';
                          }
                          else{
                              echo 'Duplicate entries found; Please fix.';
                          }
                    }
                    else
                         echo 'Unexpected error. Please contact programmer.';
               }else
                    echo 'Please type an item\'s name. i.e. Spaghetti';
          }
          else
               echo 'Please enter a food name; Click "Menu" if you want to remember a name';
     }
     if(isset($_POST['confirmation'])){
          $actionRemoval = $_POST['confirmation'];
          if($actionRemoval == 'Confirm'){
               $q="DELETE FROM `menu` WHERE `menu`.`id`='".mysqli_real_escape_string($conn, $_SESSION['idRemoval'])."'";
               if($qRun=mysqli_query($conn, $q)){
                    echo 'Item deleted.';
               }
               else
                    echo 'Unexpected error. Contact programmer.';

          }
          else if($actionRemoval == 'Cancel')
               echo 'Action canceled';
          else
               echo 'nothing selected';
     }
     if(isset($_GET['submitFoodToBeUpdated'])){
          include 'menuAdmin.inc.php';
          $itemUpdate = $_GET['foodToBeUpdated'];
          $q="SELECT `price`, `details`,`id` FROM `menu` WHERE `name`='$itemUpdate'";
          $qRun=mysqli_query($conn, $q);
          $result=mysqli_fetch_row($qRun);
          echo '<br>Current info about selection:<br>
               <table border=1 frame=void cellpadding="7">
                    <tr>
                         <th>Name</th>
                         <th>Price</th>
                         <th>Description</th></tr>
                    <tr>
                         <td>'.$itemUpdate.'</td>
                         <td>'.$result[0].'</td>
                         <td>'.$result[1].'</td></tr>
               </table><br>';
          include 'foodUpdate.inc.php';
          include 'foodUpdateComplete.inc.php';
          
     }
     if(isset($_GET['tableAdd'])){
          include 'tableMenu.inc.php';
          include 'tableAdd.inc.php';

     }
     if(isset($_GET['tableRemove'])){
          include 'tableMenu.inc.php';
          include 'tableRemove.inc.php';
     }
     if(isset($_POST['tableRemove'])){
          if(isset($_POST['tableNameRemove'])){
               $tableNameRemove=$_POST['tableNameRemove'];
               if(!empty($tableNameRemove)){
                    $q="DELETE FROM `tables` WHERE `tableNumber`='$tableNameRemove'";
                    if($qRun=mysqli_query($conn, $q)){
                         echo 'Table removed.';
                    }
                    else
                         echo 'Such table doesn\'t exist.';
               }

          }
     }
     if(isset($_POST['submitAdd'])){
          if(isset($_POST['seat']) && isset($_POST['details'])){
               $seat=htmlentities($_POST['seat']);
               $details=htmlentities($_POST['details']);
               if(!empty($seat) && !empty($details)){
                    $q="INSERT INTO `tables` (`tableNumber`, `seat`, `details`) VALUES ('', '$seat','$details')";
                    if($qRun = mysqli_query($conn, $q))
                              echo '<br>Successfully added a '.$details.' table with '.$seat.' seats.<br>';
                     else
                         echo 'Unexpected error. Please contact programmer.';
               }
               else
                    echo 'Please fill in all the fields';
          }
     }

?>
<!--INSERT INTO `menu` (`id`, `name`, `price`, `menuId`) VALUES (NULL, 'pennes4', '8.54', 'pasta');-->
