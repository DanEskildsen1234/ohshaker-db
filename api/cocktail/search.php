<?php

if( $_SERVER['REQUEST_METHOD'] !== 'GET' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

if(empty($_GET['query'])) {
    sendErrorMessage( 'No query provided' , __LINE__);
}

$query = $_GET['query'];

require_once(__DIR__ . '../../readonly-connection.php');
$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(" SELECT cName, nCocktailID 
                                 FROM tcocktail WHERE cName LIKE ?
                                 OR eShakenStired LIKE ?
                                 OR eCubedCrushed LIKE ?;
                               ");
    $statement->execute(['%'.$query.'%','%'.$query.'%','%'.$query.'%']);
    $results = $statement->fetchAll();
    $stmt = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
