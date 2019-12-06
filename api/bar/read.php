<?php
require_once(__DIR__.'../../restricted-connection.php'); // who should be able to view bars?*
require_once(__DIR__.'../../functions.php');

// restriced user login session validation*

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query("SELECT * FROM tbar");
    $results = $statement->fetchAll();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
