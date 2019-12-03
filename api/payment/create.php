<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    echo sendErrorMessage('Method not allowed', __LINE__);
}

session_start();

$iManagerID = (int)htmlspecialchars($_SESSION['managerID']); 

$db = new DB();
$con = $db->connect();

if ($con) {
// this is temp (only works with 1 credit card)
$cardID_statement = $con->prepare("SELECT `nCreditCardID` FROM `tcreditcard` WHERE `nManagerID` = $iManagerID");
$cardID_statement->execute();
$cardID_results = $cardID_statement->fetch(); // fetchAll for full list

$pCreditcardID = $cardID_results['nCreditCardID'];
$pAmount = 100; // static subscription payment

// https://www.php.net/manual/en/pdostatement.bindparam.php
// https://www.ibm.com/support/knowledgecenter/SSEPGG_11.5.0/com.ibm.swg.im.dbclient.php.doc/doc/t0023502.html
// we need to add credit card as an input for the stored procedure, right now any payment will add to the total of all the cards belonging to the manager.
$scQuery = 'CALL newPayment(?, ?)';
$procedure_statement = $con->prepare($scQuery);
$procedure_statement->bindParam(1, $pAmount, PDO::PARAM_INT);
$procedure_statement->bindParam(2, $pCreditcardID, PDO::PARAM_INT);
$procedure_statement->execute();

$db->disconnect($con);
sendSuccessMessage('Successfully added payment', __LINE__);
}