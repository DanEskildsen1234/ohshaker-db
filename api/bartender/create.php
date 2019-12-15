<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$aExpectedFields =
    array('firstName', 'surname', 'pin');

foreach ($aExpectedFields as $field) {
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

$iBarID = (int)htmlspecialchars(($_SESSION['barID']));
$sFirstName = htmlspecialchars($_POST['firstName']);
$sSurname = htmlspecialchars($_POST['surname']);
$sPin = filter_var($_POST['pin'], FILTER_SANITIZE_NUMBER_INT);

validateFirstName($sFirstName);
validateSurname($sSurname);
validatePin($sPin);

$db = new DB();
$con = $db->connect();
if ($con) {
    $con->beginTransaction();
    $results = array();

    $statement = $con->prepare(
        "
                  INSERT INTO `tbartender`(`cFirstname`, `cSurname`, `cPin`)
                  VALUES (?, ?, ?);
                  ");
    $statement->execute([$sFirstName, $sSurname, $sPin]);
    $statement = null;
    $statement = $con->prepare(
        "
                  INSERT INTO `tbarbartender`(`nBarID`, `nBartenderID`)
                  VALUES (?, LAST_INSERT_ID());
                  ");
    $statement->execute([$iBarID]);
    $statement = null;
    $con->commit();
    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been created' , __LINE__ );
}
