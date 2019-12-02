<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iManagerID = $_SESSION['managerID'];

// validation
// TODO Add validations

if( empty($_POST['field']) ){
    sendErrorMessage( 'Field is required' , __LINE__ );
}

if( empty($_POST['value']) ){
    sendErrorMessage( 'Value  is required' , __LINE__ );
    exit();
}

$sField = $_POST['field'];
$sValue = $_POST['value'];

$aAllowedFields =
    array("cFirstname", "cSurname", "cEmail", "cUsername", "cPassword", "cAddress", "cZip", "cPhoneNumber");

if (!in_array($sField, $aAllowedFields)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if ($sField === "cEmail") {
    if (!filter_var($sValue, FILTER_VALIDATE_EMAIL)) {
        sendErrorMessage( 'Email is invalid' , __LINE__ );
    }
}

if ($sField  === "cPassword") {
    $queryValue = password_hash($sValue, PASSWORD_ARGON2I);
} else {
    $queryValue = htmlspecialchars($sValue);
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "UPDATE `tmanager` SET `$sField`='$queryValue' WHERE `nManagerID`='$iManagerID'");
    $statement->execute();

    $stmt = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been updated' , __LINE__ );
}
