<?php

require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../readonly-connection.php');

session_start();

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( !empty($_SESSION['managerID']) ) {
    sendSuccessMessage( 'User already logged in' , __LINE__ );
}

$aExpectedFields =
    array("username", "password");

foreach( $aExpectedFields as $field ) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
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

    if( !password_verify($sPassword, $sPasswordChecksum) ) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    if( $results['dCancelled'] !== NULL ) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    print_r("Correct credentials");
    print_r($statement->fetch()['nManagerID']);
    $_SESSION['managerID'] =  $results['nManagerID'];
    $_SESSION['firstName'] =  $results['cFirstname'];
    $_SESSION['surname'] =  $results['cSurname'];
    $_SESSION['email'] =  $results['cEmail'];
    $_SESSION['username'] =  $results['cUsername'];
    $_SESSION['phoneNumber'] = $results['cPhoneNumber'];

    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User successfully logged in' , __LINE__ );
}
