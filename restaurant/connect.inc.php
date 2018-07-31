<?php
     $mysqlHost = 'localhost';
     $mysqlUser = 'helot';
     $mysqlPassword = '';
     $dB = 'restaurant';
     $conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword, $dB);
     if(!$conn)
          die('Oops, there was in error in our part. Please contact: admin@restaurant.org');
?>