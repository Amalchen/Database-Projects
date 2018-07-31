<?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordHash = md5($password);
        if (!empty($username) && !empty($password)) {
            $q = "SELECT `id` FROM `users` WHERE `username` = '" . mysqli_real_escape_string($conn, $username) . "' AND `password` = '" . mysqli_real_escape_string($conn, $passwordHash) . "'";
            if ($qRun = mysqli_query($conn, $q)) {
                $qNumRows = mysqli_num_rows($qRun);
                if ($qNumRows == 0) {
                    echo 'Invalid username/password combination';
                } else if($qNumRows == 1) {
                    $userID = mysqli_fetch_row($qRun);
                    $_SESSION['userID'] = $userID[0];
                    header('Location: index.php');
                }
            }
        } else {
            echo 'You must supply a username & password.';
        }
    }
?>

<form action = "" method = "POST">
    Username: <br><input type = "text" name = "username"><br>
    Password: <br><input type = "password" name = "password"><br>
    <input type = "submit" value = "Log In">
</form>
