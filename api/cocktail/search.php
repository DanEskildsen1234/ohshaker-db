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
    
    $statement = $con->prepare(" SELECT cName, nCocktailID 
                                 FROM tcocktail WHERE cName LIKE ?
                                 OR eShakenStirred LIKE ?
                                 OR eCubedCrushed LIKE ?;
                               ");
    $statement->execute(['%'.$query.'%','%'.$query.'%','%'.$query.'%']);
    $results = $statement->fetchAll();
    $stmt = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
