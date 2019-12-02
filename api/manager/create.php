<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields =
    array("barID", "firstName", "surname", "email", "username", "password", "address", "zip", "phoneNumber");

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

if (strlen($sFirstName) <= 1) {
    sendErrorMessage( 'First name has to be at least 2 characters' , __LINE__ );
}

if (strlen($sSurname) <= 1) {
    sendErrorMessage( 'Surname has to be at least 2 characters' , __LINE__ );
}

if (strlen($sFirstName) > 100){
    sendErrorMessage( 'First name cannot be longer then 100 characters' , __LINE__ );
}

if (strlen($sSurname) > 100){
    sendErrorMessage( 'Surname cannot be longer then 100 characters' , __LINE__ );
}

if( !filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage( 'Email is invalid' , __LINE__ );
}

if (strlen($sEmail) > 255){
    sendErrorMessage( 'Email cannot be longer then 100 characters' , __LINE__ );
}

if (strlen($sUsername) <= 6){
    sendErrorMessage( 'Username has to be at least 6 characters' , __LINE__ );
}

if (strlen($sUsername) > 100){
    sendErrorMessage( 'Username cannot be longer then 100 characters' , __LINE__ );
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

if( strlen($sAddress) > 50 || strlen($sAddress) <= 4 ){
    sendErrorMessage( 'Address is not valid' , __LINE__ );
}

if( strlen((string)($iZip)) > 4){
    sendErrorMessage( 'Zip is not valid' , __LINE__ );
}

if( strlen((string)($iPhoneNumber)) > 8){
    sendErrorMessage( 'Phone number has to be 8 digits. Only danish numbers are allowed' ,
        __LINE__ );
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
                                '$iBarID', '$sFirstName', '$sSurname', '$sEmail', '$sUsername', '$shashedPassword', 
                                '$sAddress', '$iZip', '$iPhoneNumber'
                            )
                  ");
    $statement->execute();
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been created' , __LINE__ );
}
