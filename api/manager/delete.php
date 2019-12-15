<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

$iBarID = (int)htmlspecialchars($_SESSION['barID']);
$iManagerID = $_SESSION['managerID'];
$sCurrentDate = date('Y-m-d');

$db = new DB();
$con = $db->connect();

if ($con) {
    $cQuery = "UPDATE `tmanager` SET `dCancelled`='$sCurrentDate' WHERE `nManagerID` = '$iManagerID'";
    $statement = $con->query($cQuery);
    $statement = null;
    $cQuery = "DELETE FROM `tbar` WHERE `nBarID` = '$iBarID'";
    $statement = $con->query($cQuery);
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'User account has been cancelled' , __LINE__ );
}

session_destroy();

