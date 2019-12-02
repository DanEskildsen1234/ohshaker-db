<?php

require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../readonly-connection.php');

session_start();

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( !empty($_SESSION['bartenderID']) ) {
    sendSuccessMessage( 'User already logged in' , __LINE__ );
}

$aExpectedFields =
    array("pin");

foreach( $aExpectedFields as $field ) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$sUsername = $_POST['username'];
$sPin = $_POST['pin'];

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare("SELECT * FROM tmanager WHERE `cUsername` = '$sUsername' LIMIT 1");
    $statement->execute();

    $results = $statement->fetch();
    $sPinCheck = $results['cPin'];

    if( $sPin === $sPinCheck) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    if( $results['dCancelled'] !== NULL ) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    print_r("Correct credentials");
    print_r($statement->fetch()['nManagerID']);
    $_SESSION['bartenderID'] =  $results['nBartenderID'];
    $_SESSION['firstName'] =  $results['cFirstname'];
    $_SESSION['surname'] =  $results['cSurname'];

    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User successfully logged in' , __LINE__ );
}
