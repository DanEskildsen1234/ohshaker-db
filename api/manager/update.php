<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__ . '../../validation.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$aExpectedFields = array("field", "value");

foreach( $aExpectedFields as $field ) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$iManagerID = $_SESSION['managerID'];
$sField = htmlspecialchars($_POST['field']);
$sValue = $_POST['value'];

$aAllowedFields =
    array('cFirstname', 'cSurname', 'cEmail', 'cUsername', 'cPassword', 'cAddress', 'cZip', 'cPhoneNumber');

if ( !in_array($sField, $aAllowedFields) ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if ($sField === "cFirstname") {
    validateFirstName($sValue);
}
if ($sField === "cSurname") {
    validateSurname($sValue);
}
if ($sField === "cEmail") {
    validateEmail($sValue);
}
if ($sField === "cUsername") {
    validateUsername($sValue);
}
if ($sField === "cAddress") {
    validateUsername($sValue);
}
if ($sField === "cZip") {
    validateUsername($sValue);
    $sValue = filter_var($sValue, FILTER_SANITIZE_NUMBER_INT);
}
if ($sField === "cPhoneNumber") {
    validateUsername($sValue);
    $sValue = filter_var($sValue, FILTER_SANITIZE_NUMBER_INT);
}
if ($sField  === "cPassword") {
    validatePassword($sValue);
    $queryValue = password_hash($sValue, PASSWORD_ARGON2I);
} else {
    $queryValue = htmlspecialchars($sValue);
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
                    "UPDATE `tmanager` SET $sField= ? WHERE `nManagerID`= ? ");
    $statement->execute([$queryValue, $iManagerID]);

    $stmt = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User has been updated' , __LINE__ );
}
