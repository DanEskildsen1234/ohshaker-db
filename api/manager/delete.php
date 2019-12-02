<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
    exit();
}

if(empty($_POST)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

$managerID = $_SESSION['managerID'];
$currentDate = date('Y-m-d');

$db = new DB();
$con = $db->connect();

if ($con) {
    $cQuery = "UPDATE `tmanager` SET `dCancelled`='$currentDate' WHERE `nManagerID` = '$managerID'";
    $statement = $con->query($cQuery);
    $statement = null;
    $db->disconnect($con);
}
