<?php
require_once(__DIR__.'../../readonly-connection.php');
$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $stmt = $con->prepare("SELECT * FROM tcreditcard");
    $stmt->execute();
    $results = $stmt->fetchAll();
    print_r(json_encode($results));
    $stmt = null;
    $db->disconnect($con);
}
