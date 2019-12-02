<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['bartenderID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iBartenderID = $_SESSION['managerID'];

$db = new DB();
$con = $db->connect();

if ($con) {
    $cQuery = "DELETE FROM `tbartender` WHERE `nBartenderID` = '$iBartenderID'";
    $statement = $con->query($cQuery);
    $statement = null;
    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been removed' , __LINE__ );
}
