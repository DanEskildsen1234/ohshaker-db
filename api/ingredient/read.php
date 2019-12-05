<?php

require_once(__DIR__.'../../readonly-connection.php');

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare("SELECT * FROM tingredient");
    $statement->execute();

    $results = $statement->fetchAll();
    echo json_encode($results));

    $statement = null;
    $db->disconnect($con);
}
