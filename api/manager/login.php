<?php

require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../readonly-connection.php');
require_once(__DIR__.'../../validation.php');

session_start();

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( !empty($_SESSION['managerID']) ) {
    sendSuccessMessage( 'User already logged in' , __LINE__ );
}

if( !empty($_SESSION['bartenderID']) ) {
    sendErrorMessage( 'Already logged in as bartender' , __LINE__ );
}

$aExpectedFields = array("username", "password");

foreach( $aExpectedFields as $field ) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$sUsername = $_POST['username'];
$sPassword = $_POST['password'];

validateUsername($sUsername);

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->prepare("SELECT * FROM tmanager WHERE `cUsername` = ?
                                         OR `cEmail` = ? LIMIT 1");
    $statement->execute([$sUsername, $sUsername]);

    $results = $statement->fetch();
    $sPasswordChecksum = $results['cPassword'];

    if( !password_verify($sPassword, $sPasswordChecksum) ) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    if( $results['dCancelled'] !== NULL ) {
        sendErrorMessage( 'Incorrect credentials' , __LINE__ );
    }

    $_SESSION['managerID'] =  $results['nManagerID'];
    $_SESSION['barID'] =  $results['nBarID'];
    $_SESSION['firstName'] =  $results['cFirstname'];
    $_SESSION['surname'] =  $results['cSurname'];
    $_SESSION['email'] =  $results['cEmail'];
    $_SESSION['username'] =  $results['cUsername'];
    $_SESSION['phoneNumber'] = $results['cPhoneNumber'];

    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User successfully logged in' , __LINE__ );
}
