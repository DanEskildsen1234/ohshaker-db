<?php
require_once(__DIR__.'../../readonly-connection.php');

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query("SELECT * FROM tcocktail");
    $results = $statement->fetchAll();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
