<?php
session_status() == PHP_SESSION_NONE ? session_start() : null;

if(isset($_POST['submit'])){
    $username = trim($_POST['email']);//finish this line
    $password = trim($_POST['password']);//finish this

if(loginUser($username, $password)){
    header("Location:../dashboard.php");
} else {
    echo "Login Details Incorrect!";
    echo '<meta http-equiv="refresh" content="2; url=../forms/login.html">';
}

}

function loginUser($email, $password){
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */
    $db = "../storage/users.csv";
    $handle = fopen($db, 'r');

    while (!feof($handle) ) {
        $data [] = fgetcsv($handle, 1000, ",");
    }

    $db_username = $data[0][0];
    $db_email = $data[0][1];
    $db_password = $data[0][2];

    if($email == $db_email){
        if($password == $db_password){
            $username = $db_username;
            $_SESSION['username'] = $username;
            return true;
        } else return false;
    } else return false;

    fclose($handle);
}


