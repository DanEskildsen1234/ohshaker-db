<?php
require_once(__DIR__.'../../readonly-connection.php');

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare("SELECT * FROM tcocktail");
    $statement->execute();
    $results = $statement->fetchAll();
    $stmt = null;
    $db->disconnect($con);
    echo json_encode($results);
}
