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
    $results = array();
    $statement = $con->prepare("SELECT tpayment.nPaymentID, tpayment.nCreditCardID, tpayment.nAmount, tpayment.dPayment FROM tpayment INNER JOIN tcreditcard ON tcreditcard.nCreditCardID = tpayment.nCreditCardID INNER JOIN tmanager ON tmanager.nManagerID = tcreditcard.nManagerID WHERE tmanager.nManagerID = $iManagerID");
    $statement->execute();
    $results = $statement->fetchAll();
    echo json_encode($results);
    $statement = null;

    $db->disconnect($con);
}
