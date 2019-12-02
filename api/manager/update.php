<?php

require_once(__DIR__ . '../../admin-connection.php');

session_start();

if(empty($_SESSION['managerID'])) {
    echo 'Not authenticated';
    exit();
}

$managerID = $_SESSION['managerID'];

// validation
// TODO Add validations

if( empty($_POST['field']) ){
    echo 'Field is required';
    exit();
}

if( empty($_POST['value']) ){
    echo 'Value is required';
    exit();
}

$sField = $_POST['field'];
$sValue = $_POST['value'];

$aAllowedFields =
    array("cFirstname", "cSurname", "cEmail", "cUsername", "cPassword", "cAddress", "cZip", "cPhoneNumber");

if (!in_array($sField, $aAllowedFields)) {
    echo 'Method not allowed';
    exit();
}

if ($sField === "cEmail") {
    if (!filter_var($sValue, FILTER_VALIDATE_EMAIL)) {
        echo 'Email is invalid';
        exit();
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
        "UPDATE `tmanager` SET `$sField`='$queryValue' WHERE `nManagerID`='$managerID'");
    $statement->execute();

    echo("Success");

    $stmt = null;
    $db->disconnect($con);

}