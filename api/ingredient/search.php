<?php
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'GET' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_GET['query'])) {
    sendErrorMessage( 'No query provided' , __LINE__);
}

$query = $_GET['query'];

require_once(__DIR__ . '../../restricted-connection.php');
$db = new DB();
$con = $db->connect();
if ($con) {

    $statement = $con->prepare(" SELECT cName, nIngredientID 
                                 FROM tingredient WHERE cName LIKE ?");
    $statement->execute(['%'.$query.'%']);
    $results = $statement->fetchAll();
    $stmt = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
