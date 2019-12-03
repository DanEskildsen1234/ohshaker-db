<?php

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( empty($_POST["bartenderID"]) ) {
    sendErrorMessage( "bartenderID is required" , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iBartenderID = (int)htmlspecialchars($_POST['bartenderID']);
$iBarID = (int)htmlspecialchars($_SESSION['barID']);

$db = new DB();
$con = $db->connect();

if ($con) {
    $cQuery = "
               DELETE tbartender FROM tbarbartender 
               INNER JOIN tbartender ON tbarbartender.nBartenderID = tbartender.nBartenderID 
               WHERE tbartender.nBartenderID = '$iBartenderID' AND tbarbartender.nBarID = '$iBarID';
               ";
    $statement = $con->prepare($cQuery);
    $statement->execute();
    $statement = null;

    $db->disconnect($con);

    sendSuccessMessage( 'Bartender has been removed' , __LINE__ );
}
