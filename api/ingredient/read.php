<?php

require_once(__DIR__.'../../restricted-connection.php');

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare("SELECT * FROM tingredient");
    $statement->execute();
    $results = $statement->fetchAll();
    $statement = null;
    $db->disconnect($con);
    echo json_encode($results);
}
