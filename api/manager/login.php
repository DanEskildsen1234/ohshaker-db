<?php

session_start();

if(empty($_SESSION['managerID']) !== true) {
    print_r("Already logged in");
    exit();
}

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
    $statement = $con->prepare("SELECT * FROM tmanager WHERE `cUsername` = '$sUsername' 
                                         OR `cEmail` = '$sUsername' LIMIT 1");
    $statement->execute();

    $results = $statement->fetch();
    $sPasswordChecksum = $results['cPassword'];

    if (!password_verify($sPassword, $sPasswordChecksum)) {
        print_r("Incorrect credentials");
        exit();
    }

    if ($results['dCancelled'] !== NULL) {
        print_r("Incorrect credentials");
        exit();
    }

    print_r("Correct credentials");
    print_r($statement->fetch()['nManagerID']);
    $_SESSION['managerID'] =  $results['nManagerID'];
    $_SESSION['firstName'] =  $results['cFirstname'];
    $_SESSION['surname'] =  $results['cSurname'];
    $_SESSION['email'] =  $results['cEmail'];
    $_SESSION['username'] =  $results['cUsername'];
    $_SESSION['phoneNumber'] = $results['cPhoneNumber'];

    $stmt = null;
    $db->disconnect($con);

}