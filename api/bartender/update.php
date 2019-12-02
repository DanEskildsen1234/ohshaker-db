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
$sField = $_POST['field'];
$sValue = $_POST['value'];

$aAllowedFields =
    array('cFirstname', 'cSurname', 'cPin');

if ( !in_array($sField, $aAllowedFields) ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}
if ($sField === "cFirstname") {
    validateFirstName($sValue);
}
if ($sField === "cSurname") {
    validateSurname($sValue);
}
if ($sField  === "cPin") {
    validatePin($sValue);
}

$queryValue = htmlspecialchars($sValue);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "UPDATE `tmanager` SET `$sField`='$queryValue' WHERE `nManagerID`='$iManagerID'");
    $statement->execute();

    $stmt = null;
    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been updated' , __LINE__ );
}
