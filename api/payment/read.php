<?php
require_once(__DIR__.'../../readonly-connection.php');
require_once(__DIR__.'../../functions.php');

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    sendErrorMessage( 'Method not allowed' , __LINE__ );
}

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage('Not authenticated' , __LINE__);
}

$iManagerID = (int)$_SESSION['managerID'];

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query(
    "SELECT tpayment.nPaymentID, tpayment.nCreditCardID, tpayment.nAmount, tpayment.dPayment FROM tpayment 
    INNER JOIN tcreditcard ON tcreditcard.nCreditCardID = tpayment.nCreditCardID
    INNER JOIN tmanager ON tmanager.nManagerID = tcreditcard.nManagerID
    WHERE tmanager.nManagerID = $iManagerID");
    $results = $statement->fetchAll();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
