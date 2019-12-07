<?php
require_once(__DIR__.'../../readonly-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

// TODO
// if bartender..

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

$iBarID = (int)($_SESSION['barID']);

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query(
    "SELECT * FROM tbartender bt
    INNER JOIN tbarbartender bbt ON bbt.nBartenderID = bt.nBartenderID 
    WHERE bbt.nBarID = '$iBarID'");

    $results = $statement->fetchAll();

    $statement = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
