<?php

require_once(__DIR__.'../../readonly-connection.php');

if( empty($_POST['password']) ){
    echo 'Password is required';
    return;
}

if( empty($_POST['username']) ){
    echo 'Username is required';
    return;
}

$sUsername = $_POST['username'];
$sPassword = $_POST['password'];

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare("SELECT `cPassword` FROM tmanager WHERE `cUsername` = '$sUsername' 
                                         OR `cEmail` = '$sUsername'  LIMIT 1");
    $statement->execute();

    $sPasswordChecksum = $statement->fetch()['cPassword'];

    if (!password_verify($sPassword, $sPasswordChecksum)) {
        print_r("Incorrect credentials");
        exit();
    }
    print_r("Correct credentials");

    $stmt = null;
    $db->disconnect($con);

}