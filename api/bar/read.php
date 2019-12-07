<?php
require_once(__DIR__.'../../restricted-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_SESSION['bartenderID']) && empty($_SESSION['bartenderID'])) {
    sendErrorMessage('Not authenticated' , __LINE__);
}

// TODO
// if manager..

session_start();
$iBartenderID = $_SESSION['bartenderID'];

// OR MANAGER session
// validate session

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query(
        "SELECT * FROM tbar INNER JOIN tbarbartender ON tbarbartender.nbarID = tbar.nbarID
        WHERE tbarbartender.nbartenderID = $iBartenderID");
    $results = $statement->fetchAll();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
