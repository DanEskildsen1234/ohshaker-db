<?php
require_once(__DIR__.'../../readonly-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

// Both manager and bartender is able to view this data
if(empty($_SESSION['managerID']) && empty($_SESSION['bartenderID'])) {
    sendErrorMessage('Not authenticated' , __LINE__);
}

if(!empty($_SESSION['managerID'])){
    $iManagerID = $_SESSION['managerID'];
} else {
    $iManagerID = 0; // ID in db doesn't allow for null or empty values - And the query wouldnt accept the variable if not included
}

if(!empty($_SESSION['bartenderID'])){
    $iBartenderID = $_SESSION['bartenderID'];
} else {
    $iBartenderID = 0;
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query(
        "SELECT tbar.nBarID, tbar.cName FROM tbar
        INNER JOIN tmanager ON tbar.nBarID = tmanager.nBarID
        INNER JOIN tbarbartender ON tbar.nBarID = tbarbartender.nBarID
        WHERE tmanager.nManagerID = $iManagerID OR tbarbartender.nBartenderID = $iBartenderID;
        ");
    $results = $statement->fetch();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
