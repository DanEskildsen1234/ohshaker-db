<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

$aExpectedFields =
    array('firstName', 'surname', 'pin');

foreach ($aExpectedFields as $field) {
    if( empty($_POST["$field"]) ) {
        sendErrorMessage( "$field is required" , __LINE__ );
    }
}

$iBarID = (int)htmlspecialchars(($_SESSION['barID']));
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurname = htmlspecialchars($_POST['surname']);
$sPin = htmlspecialchars($_POST['pin']);

validateFirstName($sFirstName);
validateSurname($sSurname);
validatePin($sPin);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "
                  INSERT INTO `tbartender`(`cFirstname`, `cSurname`, `cPin`)
                  VALUES ('$sFirstName', '$sSurname', '$sPin');
                  ");
    $statement->execute();
    $statement = null;
    $statement = $con->prepare(
        "
                  INSERT INTO `tbarbartender`(`nBarID`, `nBartenderID`)
                  VALUES ('$iBarID', LAST_INSERT_ID());
                  ");
    $statement->execute();
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been created' , __LINE__ );
}
