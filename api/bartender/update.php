<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__ . '../../validation.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields = array("field", "value");

foreach( $aExpectedFields as $field ) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

if( empty($_POST["bartenderID"]) ) {
    sendErrorMessage( "bartenderID is required" , __LINE__ );
}

$iBartenderID = (int)htmlspecialchars($_POST['bartenderID']);
$iBarID = (int)htmlspecialchars($_SESSION['barID']);
$sField = htmlspecialchars($_POST['field']);
$sValue = $_POST['value'];

$aAllowedFields = array('cFirstname', 'cSurname', 'cPin');

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
    $sValue = filter_var($sValue,FILTER_SANITIZE_NUMBER_INT);
}

$queryValue = htmlspecialchars($sValue);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "
                   UPDATE tbartender bt
                    INNER JOIN tbarbartender bbt
                        ON bbt.nBartenderID = bt.nBartenderID 
                    SET `$sField` = ?
                    WHERE bt.nBartenderID = ? AND bbt.nBarID = ?;
                 ");
    $statement->execute([$queryValue, $iBartenderID, $iBarID]);

    $stmt = null;
    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been updated' , __LINE__ );
}
