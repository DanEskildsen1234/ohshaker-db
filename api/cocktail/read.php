<?php

require_once(__DIR__.'../../readonly-connection.php');
$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare("SELECT * FROM tcocktail");
    $statement->execute();
    $results = $statement->fetchAll();
    print_r(json_encode($results));
    $stmt = null;
    $db->disconnect($con);
}
