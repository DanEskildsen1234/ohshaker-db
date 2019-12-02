<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

// validation
// TODO Add validations

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( empty($_POST['email']) ){
    sendErrorMessage( 'Email is required' , __LINE__ );
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage( 'Email is invalid' , __LINE__ );
}

if( empty($_POST['password']) ){
    sendErrorMessage( 'Password is invalid' , __LINE__ );
}

if (strlen($_POST["password"]) <= 12) {
    sendErrorMessage( 'Password needs to be at least 12 characters' , __LINE__ );
}

if( strlen($_POST['password']) > 255 ){
    sendErrorMessage( 'Password cannot be longer then 255 characters' , __LINE__ );
}

if(!preg_match("#[0-9]+#",$_POST['password'])) {
    sendErrorMessage( 'Password needs to contain at least one number' , __LINE__ );
}

if(!preg_match("#[A-Z]+#",$_POST['password'])) {
    sendErrorMessage( 'Password needs to contain at least one capitalized letter' , __LINE__ );
}

if(!preg_match("#[a-z]+#",$_POST['password'])) {
    sendErrorMessage( 'Password needs to contain at least one lowercase letter' , __LINE__ );
}

$iBarId = htmlspecialchars($_POST['barID']);
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurName = htmlspecialchars($_POST['surName']);
$sEmail = htmlspecialchars($_POST['email']);
$sUsername = htmlspecialchars($_POST['username']);
$sPassword = password_hash($_POST['password'], PASSWORD_ARGON2I);
$sAddress = htmlspecialchars($_POST['address']);
$sZip = htmlspecialchars($_POST['zip']);
$sPhoneNumber = htmlspecialchars($_POST['phoneNumber']);


$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "INSERT INTO `tmanager`(`nBarID`, `cFirstname`, `cSurname`, `cEmail`, `cUsername`, `cPassword`, 
                                `cAddress`, `cZip`, `cPhoneNumber`) 
                        VALUES (
                                '$iBarId', '$sFirstName', '$sSurName', '$sEmail', '$sUsername', '$sPassword', 
                                '$sAddress', '$sZip', '$sPhoneNumber'
                            )
                  ");
    $statement->execute();
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been created' , __LINE__ );
}
