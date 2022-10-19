<?php
session_status() == PHP_SESSION_NONE ? session_start() : null;

if(isset($_POST['submit'])){

    $email = trim($_POST['email']);
    $newpassword = trim($_POST['password']);

    if(resetPassword($email, $newpassword)){
        echo "Password reset successful!";
        echo '<meta http-equiv="refresh" content="2; url=../forms/login.html">';
    } else echo "User does not exist!";
}

function resetPassword($email, $newpassword){

    //open file and check if the username exist inside
    //if it does, replace the password

    //get db file and open for reading
    $db = "../storage/users.csv";
    $handle = fopen($db, 'r');

    while (!feof($handle) ) {
        $data [] = fgetcsv($handle, 1000, ",");
    }
    //confirm consistency with form input
    $db_username = $data[0][0];
    $db_email = $data[0][1];
    $db_password = $data[0][2];

    if($email == $db_email){
        //if same user, update password
        $handle = fopen($db, 'w');
        $data = array($db_username, $db_email, $newpassword);
        $delimeter = ",";
        
        if(fputcsv($handle, $data, $delimeter)){
            return true;
         } else return false;

    } else return false;

    fclose($handle);
}


