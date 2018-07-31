<?php
     //ob_start();
     session_start();
     //$currentFile=$_SERVER['SCRIPT_FILENAME'];
     $currentFile=$_SERVER['SCRIPT_NAME'];
     //echo 'Current File is: '.$currentFile.'<br>';
     if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
          $httpReferer = $_SERVER['HTTP_REFERER'];
     }

     function loggedIn(){
          if(isset($_SESSION['userID']) && !empty($_SESSION['userID']))
               return TRUE;
          else
               return FALSE;
     }

     function getUserField($conn, $field){
          $q="SELECT `$field` FROM `users` WHERE `id`='".$_SESSION['userID']."'";
          if($qRun = mysqli_query($conn, $q))
                 if($qRunField=mysqli_fetch_row($qRun))
                    return $qRunField[0];
     }
?>