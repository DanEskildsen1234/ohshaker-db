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

$sExpiration = htmlspecialchars($_POST['expiration']);
$iCCV = filter_var($_POST['CCV'], FILTER_SANITIZE_NUMBER_INT); // can start with 0
$sIBAN = $_POST['IBAN'];

// https://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format
if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0{2})$/", $sExpiration)) {
    echo sendErrorMessage('Expiration date must be a valid date', __LINE__);
}

if (strlen($iCCV) != 3) {
    echo sendErrorMessage('CCV must be exactly 3 numbers', __LINE__);
}

if (strlen($sIBAN) != 18) {
    echo sendErrorMessage('IBAN must be exactly 18 charecters', __LINE__);
}

if (!preg_match("/DK\d{16}$/", $sIBAN)) {
    echo sendErrorMessage('IBAN must be valid', __LINE__);
}

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iManagerID = (int)htmlspecialchars($_SESSION['managerID']);

validateExpirationDate($sExpiration);
validateCCV($iCCV);
validateIBAN($sIBAN);

validateExpirationDate($sExpiration);
validateCCV($iCCV);
validateIBAN($sIBAN);

$db = new DB();
$con = $db->connect();

if ($con) {
$scQuery = "INSERT INTO tcreditcard (`nManagerID`, `dExpiration`, `cCCV`, `cIBAN`) VALUES (?, ?, ?, ?)";
$statement = $con->prepare($scQuery);
$statement->execute([$iManagerID, $sExpiration, $iCCV, $sIBAN]);
$statement = null;

$db->disconnect($con);
sendSuccessMessage('Successfully added credit card', __LINE__);
}
