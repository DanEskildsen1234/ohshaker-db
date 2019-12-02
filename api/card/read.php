<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare("SELECT * FROM tcreditcard");
    $statement->execute();
    $results = $statement->fetchAll();
    $statement = null;
    $db->disconnect($con);
    echo sendSuccessMessage('Successfully fetched credit cards: '.json_encode($results), __LINE__);
}
