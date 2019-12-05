<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields =
    array('barName', 'firstName', 'surname', 'email', 'username', 'password', 'address', 'zip', 'phoneNumber',
    "expiration", "CCV", "IBAN");

foreach ($aExpectedFields as $field) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$sBarName = htmlspecialchars(($_POST['barName']));
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurname = htmlspecialchars($_POST['surname'], ENT_QUOTES);
$sEmail = htmlspecialchars($_POST['email']);
$sUsername = htmlspecialchars($_POST['username']);
$sPassword = $_POST['password'];
$sAddress = htmlspecialchars($_POST['address']);
$iZip = (int)htmlspecialchars($_POST['zip']);
$iPhoneNumber = (int)htmlspecialchars($_POST['phoneNumber']);
$sExpiration = htmlspecialchars($_POST['expiration']);
$iCCV = (int)htmlspecialchars($_POST['CCV']);
$sIBAN = $_POST['IBAN'];

validateFirstName($sFirstName);
validateSurname($sSurname);
validateEmail($sEmail);
validateUsername($sUsername);
validatePassword($sPassword);
validateAddress($sAddress);
validateZip($iZip);
validatePhoneNumber($iPhoneNumber);
validateBarName($sBarName);
validateExpirationDate($sExpiration);
validateCCV($iCCV);
validateIBAN($sIBAN);

$shashedPassword = password_hash($sPassword, PASSWORD_ARGON2I);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare("INSERT INTO `tbar`(`cName`) VALUES ('$sBarName')");
    $statement->execute();
    $statement = null;
    $statement = $con->prepare(
        "INSERT INTO `tmanager`(`nBarID`, `cFirstname`, `cSurname`, `cEmail`, `cUsername`, `cPassword`, 
                                `cAddress`, `cZip`, `cPhoneNumber`) 
                   VALUES (
                           LAST_INSERT_ID(), ?, ?, ?, ?, ?, ?, ?, ?) 
                   ");
    $statement->execute([$sFirstName, $sSurname, $sEmail, $sUsername, $shashedPassword,
                        $sAddress, $iZip, $iPhoneNumber]);
    $statement = null;
    $statement = $con->prepare(
        "INSERT INTO tcreditcard (`nManagerID`, `dExpiration`, `cCCV`, `cIBAN`) 
                  VALUES (LAST_INSERT_ID(), ?, ?, ?)
                  ");
    $statement->execute([$sExpiration, $iCCV, $sIBAN]);
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'Manager and bar have been created' , __LINE__ );
}
