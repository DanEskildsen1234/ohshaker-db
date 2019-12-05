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
                                            FROM tcocktail WHERE cName LIKE '%$query%' 
                                            OR eShakenStired LIKE '%$query%'   
                                            OR eCubedCrushed LIKE '%$query%';
                                          ");
    $statement->execute();
    $results = $statement->fetchAll();
    echo(json_encode($results));
    $stmt = null;
    $db->disconnect($con);
}
