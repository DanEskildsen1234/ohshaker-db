<?php

require_once(__DIR__.'../../readonly-connection.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if( empty($_SESSION['managerID']) ) {
    sendErrorMessage( 'Not authenticated' , __LINE__ );
}

if( empty($_SESSION['barID']) ) {
    sendErrorMessage( 'Corrupt session: barID is not defined' , __LINE__ );
}

$iBarID = (int)htmlspecialchars($_SESSION['barID']);

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();

    $statement = $con->prepare(
        "SELECT * FROM tbartender bt
                    INNER JOIN tbarbartender bbt
                        ON bbt.nBartenderID = bt.nBartenderID
                    WHERE bbt.nBarID = ?;
                 ");
    $statement->execute([$iBarID]);

    $results = $statement->fetchAll();

    $statement = null;
    $db->disconnect($con);
    echo(json_encode($results));
}
