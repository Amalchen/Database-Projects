<?php
     require 'adminConnect.inc.php';
     require 'core.inc.php';

     if(!loggedIn()){
          if(isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passCheck'])){
               $firstname=$_POST['firstname'];
               $surname=$_POST['surname'];
               $username=$_POST['username'];
               $password=$_POST['password'];
               $passCheck=$_POST['passCheck'];
               $passwordHash=md5($password);
               if(!empty($firstname) && !empty($surname) && !empty($username) && !empty($password) && !empty($passCheck)){
                    if( strlen($username)>30 || strlen($firstname)>40 || strlen($surname)>40)
                         echo 'Please adhere to maxlength of fields.';
                    else
                         if($password != $passCheck)
                              echo 'Passwords do no match.';
                         else{
                              //starting Registration Proccess
                              $q="SELECT `username` FROM `users` WHERE `username`='$username'";
                              $qRun = mysqli_query($conn, $q);
                              if(mysqli_num_rows($qRun)==1)
                                   echo 'The username '.$username.' already exists.';
                              else
                                   //starting Registration Proccess
                                   $q="INSERT INTO `users` VALUES('', '".mysqli_real_escape_string($conn, $username)."',
                                                                      '".mysqli_real_escape_string($conn, $passwordHash)."',
                                                                      '".mysqli_real_escape_string($conn, $firstname)."',
                                                                      '".mysqli_real_escape_string($conn, $surname)."'
                                                                 )";
                                   if($qRun = mysqli_query($conn, $q))
                                        header('Location: registerSuccess.php');
                                   else
                                        echo 'Sorry, couldn\'t register you at this time. Try again later.';
                         }
               }else
                    echo 'Please fill in all the forms.';
          }
     //kleinw meta to form
?>
<form action="register.php" method="POST">
     Firstname:<br><input type="text" name="firstname" maxlength="37" value="<?php if(isset($firstname)) echo $firstname;?>"><br><br>
     Surname:<br><input type="text" name="surname" maxlength="37" value="<?php if(isset($surname)) echo $surname;?>"><br><br>
     Username:<br><input type="text" name="username" maxlength="30" value="<?php if(isset($username)) echo $username;?>"><br><br>
     Password:<br><input type="password" name="password"><br><br>
     Retype your Password:<br><input type="password" name="passCheck"><br><br>
     <input type="submit" value="Register">

</form>

<?php
     }
     else if(loggedIn())
          echo 'You are already registered and logged in.';
?>