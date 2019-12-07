<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage('Not authenticated' , __LINE__);
}

$iManagerID = (int)htmlspecialchars($_SESSION['managerID']);

$db = new DB();
$con = $db->connect();
if ($con) {
    $statement = $con->query("SELECT tpayment.nPaymentID, tpayment.nCreditCardID, tpayment.nAmount, tpayment.dPayment FROM tpayment INNER JOIN tcreditcard ON tcreditcard.nCreditCardID = tpayment.nCreditCardID INNER JOIN tmanager ON tmanager.nManagerID = tcreditcard.nManagerID WHERE tmanager.nManagerID = $iManagerID");
    $results = $statement->fetchAll();
    $statement = null;
    
    $db->disconnect($con);
    echo json_encode($results);
}
