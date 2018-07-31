<?php
    require 'connect.inc.php';
    require 'core.inc.php';

    if (loggedIn()) {
        $firstname = getUserField($conn, 'firstname');
        $surname = getUserField($conn, 'surname');
        echo 'Welcome, mr. ' . $firstname . ' ' . $surname . '!<br><a href="logout.php">Log out</a>';
        $username = getUserField($conn, 'username');
        if ($username == 'admin') {
            header('Location: botrini.php');
        } else {
            include 'loggedIn.inc.php';
        }
    } else {
        include 'loginform.inc.php';
        echo '<br>Not a member yet? Click <a href="http://localhost/luke/register.php">here</a> to register.';
    }
?>