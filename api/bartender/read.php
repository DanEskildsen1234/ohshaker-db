<?php

require_once(__DIR__.'../../readonly-connection.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare("SELECT * FROM tbartender");
    $statement->execute();

    $results = $statement->fetchAll();
    print_r(json_encode($results));

    $statement = null;
    $db->disconnect($con);
}
