<?php

require_once(__DIR__.'../../readonly-connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iManagerID = (int)$_SESSION['managerID'];

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare("
                                          SELECT * FROM tmanager 
                                          WHERE `nManagerID`= $iManagerID;
                                        ");
    $statement->execute();

    $results = $statement->fetch();

    $statement = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
