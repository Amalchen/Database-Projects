<?php
    $mysqlHost = 'localhost';
    $mysqlUser = 'adminoras';
    $mysqlPassword = '';
    $dB = 'restaurant';
    $conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword, $dB);
    if (!$conn) {
        die('Oops, there was in error in our part. Please contact programmer.');
    }
?>