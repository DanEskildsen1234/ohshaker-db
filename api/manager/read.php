<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$iManagerID = (int)$_SESSION['managerID'];

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query("SELECT * FROM tmanager WHERE `nManagerID`= $iManagerID LIMIT 1");

    $results = $statement->fetch();

    $statement = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
