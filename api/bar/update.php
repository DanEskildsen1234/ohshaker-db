<?php
require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__ . '../../validation.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( empty($_POST['barName']) ) {
    sendErrorMessage('barName is required' , __LINE__ );
}

session_start();
if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}
if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

$iManagerID = htmlspecialchars($_SESSION['managerID'], ENT_QUOTES);
$iBarID = (int)htmlspecialchars($_SESSION['barID'], ENT_QUOTES);
$sBarName = htmlspecialchars($_POST['barName'], ENT_QUOTES);

validateFirstName($sBarName);

$queryValue = htmlspecialchars($sBarName);
$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(
        "
                   UPDATE tbar
                    INNER JOIN tmanager
                        ON tmanager.nBarID = tbar.nBarID 
                    SET `cName` = '$sBarName'
                    WHERE tmanager.nManagerID = '$iManagerID' AND tbar.nBarID = '$iBarID';
                 ");
    $statement->execute();
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage( 'Bar name has been updated' , __LINE__ );
}
