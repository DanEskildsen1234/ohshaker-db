<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

// validation
// TODO Add validations

if( $_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields =
    array("barID","firstName", "surName", "email", "username", "password", "address", "zip", "phoneNumber");

foreach ($aExpectedFields as $field) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$iBarID = htmlspecialchars($_POST['barID']);
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurName = htmlspecialchars($_POST['surName']);
$sEmail = htmlspecialchars($_POST['email']);
$sUsername = htmlspecialchars($_POST['username']);
$sPassword = $_POST['password'];
$sAddress = htmlspecialchars($_POST['address']);
$sZip = htmlspecialchars($_POST['zip']);
$sPhoneNumber = htmlspecialchars($_POST['phoneNumber']);

if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage( 'Email is invalid' , __LINE__ );
}

if (strlen($sPassword) <= 12) {
    sendErrorMessage( 'Password needs to be at least 12 characters' , __LINE__ );
}

if( strlen($sPassword) > 255 ){
    sendErrorMessage( 'Password cannot be longer then 255 characters' , __LINE__ );
}

if( !preg_match("#[0-9]+#",$sPassword)) {
    sendErrorMessage( 'Password needs to contain at least one number' , __LINE__ );
}

if( !preg_match("#[A-Z]+#",$sPassword)) {
    sendErrorMessage( 'Password needs to contain at least one capitalized letter' , __LINE__ );
}

if( !preg_match("#[a-z]+#",$sPassword)) {
    sendErrorMessage( 'Password needs to contain at least one lowercase letter' , __LINE__ );
}

$shashedPassword = password_hash($sPassword, PASSWORD_ARGON2I);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "INSERT INTO `tmanager`(`nBarID`, `cFirstname`, `cSurname`, `cEmail`, `cUsername`, `cPassword`, 
                                `cAddress`, `cZip`, `cPhoneNumber`) 
                        VALUES (
                                '$iBarID', '$sFirstName', '$sSurName', '$sEmail', '$sUsername', '$shashedPassword', 
                                '$sAddress', '$sZip', '$sPhoneNumber'
                            )
                  ");
    $statement->execute();
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been created' , __LINE__ );
}
