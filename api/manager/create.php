<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'/validation.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields =
    array('barID', 'firstName', 'surname', 'email', 'username', 'password', 'address', 'zip', 'phoneNumber');

foreach ($aExpectedFields as $field) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$iBarID = (int)htmlspecialchars(($_POST['barID']));
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurname = htmlspecialchars($_POST['surname']);
$sEmail = htmlspecialchars($_POST['email']);
$sUsername = htmlspecialchars($_POST['username']);
$sPassword = $_POST['password'];
$sAddress = htmlspecialchars($_POST['address']);
$iZip = (int)htmlspecialchars($_POST['zip']);
$iPhoneNumber = (int)htmlspecialchars($_POST['phoneNumber']);

validateFirstName($sFirstName);
validateSurname($sSurname);
validateEmail($sEmail);
validateUsername($sUsername);
validatePassword($sPassword);
validateAddress($sAddress);
validateZip($iZip);
validatePhoneNumber($iPhoneNumber);

$shashedPassword = password_hash($sPassword, PASSWORD_ARGON2I);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "INSERT INTO `tmanager`(`nBarID`, `cFirstname`, `cSurname`, `cEmail`, `cUsername`, `cPassword`, 
                                `cAddress`, `cZip`, `cPhoneNumber`) 
                        VALUES (
                                '$iBarID', '$sFirstName', '$sSurname', '$sEmail', '$sUsername', '$shashedPassword', 
                                '$sAddress', '$iZip', '$iPhoneNumber'
                            )
                  ");
    $statement->execute();
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been created' , __LINE__ );
}
