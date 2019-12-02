<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

// validation
// TODO Add validations

if(empty($_POST)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( empty($_POST['email']) ){
    echo 'Email is required';
    return;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo 'Email is invalid';
    return;
}

if( empty($_POST['password']) ){
    echo 'Password is required';
    return;
}

if (strlen($_POST["password"]) <= 12) {
    echo "Your password must contain at least 12 characters";
    return;
}

if( strlen($_POST['password']) > 255 ){
    echo 'Password cannot be longer then 255 characters';
    return;
}

if(!preg_match("#[0-9]+#",$_POST['password'])) {
    echo 'A password needs to contain at least one number';
    return;
}

if(!preg_match("#[A-Z]+#",$_POST['password'])) {
    echo "A password needs to contain at least one capitalized letter";
    return;
}

if(!preg_match("#[a-z]+#",$_POST['password'])) {
    echo "A password needs to contain at least one lowercase letter";
    return;
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

    echo("Success");

    $statement = null;
    $db->disconnect($con);
}
