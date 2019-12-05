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

$iManagerID = (int)htmlspecialchars($_SESSION['managerID']);
$iBarID = (int)htmlspecialchars($_SESSION['barID']);
$sBarName = htmlspecialchars($_POST['barName'], ENT_QUOTES);

validateBarName($sBarName);

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
                    SET `cName` = ?
                    WHERE tmanager.nManagerID = ? AND tbar.nBarID = ?;
                 ");
    $statement->execute([$sBarName, $iManagerID, $iBarID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage( 'Bar name has been updated' , __LINE__ );
}
