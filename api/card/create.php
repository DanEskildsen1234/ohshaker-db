<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    echo sendErrorMessage('Method not allowed', __LINE__);
}

$aExpectedFields =
    array("expiration", "CCV", "IBAN");
foreach ($aExpectedFields as $field) {
    if(empty($_POST["$field"])) {
        sendErrorMessage("$field is required", __LINE__);
    }
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iManagerID = (int)htmlspecialchars($_SESSION['managerID']);
$sExpiration = htmlspecialchars($_POST['expiration']);
$iCCV = (int)htmlspecialchars($_POST['CCV']);
$sIBAN = $_POST['IBAN'];

validateExpirationDate($sExpiration);
validateCCV($iCCV);
validateIBAN($sIBAN);

$db = new DB();
$con = $db->connect();

if ($con) {
$scQuery = "INSERT INTO tcreditcard (`nManagerID`, `dExpiration`, `cCCV`, `cIBAN`) VALUES ('$iManagerID', '$sExpiration', '$iCCV', '$sIBAN')";
$statement = $con->prepare($scQuery);
$statement->execute();
$statement = null;

$db->disconnect($con);
sendSuccessMessage('Successfully added credit card', __LINE__);
}
