<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    echo sendErrorMessage('Method not allowed', __LINE__);
}

if(empty($_POST['cardID'])) {
    sendErrorMessage('Please enter credit card ID' , __LINE__);
}

if(!is_numeric($_POST['cardID'])) {
    sendErrorMessage('credit card ID must contain only numbers' , __LINE__);
}

session_start();

if(empty($_SESSION['managerID'])) {
    sendErrorMessage('Not authenticated' , __LINE__);
}

$db = new DB();
$con = $db->connect();

if ($con) {
// if only 1 credit card this can be used (eg. count)
/*$iManagerID = (int)htmlspecialchars($_SESSION['managerID']);
$cardID_statement = $con->prepare("SELECT `nCreditCardID` FROM `tcreditcard` WHERE `nManagerID` = $iManagerID");
$cardID_statement->execute();
$cardID_results = $cardID_statement->fetch(); // fetchAll for full list
$pCreditcardID = $cardID_results['nCreditCardID'];*/

$pCreditcardID = (int)$_POST['cardID'];
$pAmount = 100; // static subscription payment

// select statement for checking existing card id's

// https://www.php.net/manual/en/pdostatement.bindparam.php
// https://www.ibm.com/support/knowledgecenter/SSEPGG_11.5.0/com.ibm.swg.im.dbclient.php.doc/doc/t0023502.html
// calling stored procedure
$scQuery = 'CALL newPayment(?, ?)';
$statement = $con->prepare($scQuery);
$statement->bindParam(1, $pAmount, PDO::PARAM_INT);
$statement->bindParam(2, $pCreditcardID, PDO::PARAM_INT);
$statement->execute([$pAmount, $pCreditcardID]);
$statement = null;

$db->disconnect($con);

sendSuccessMessage('Successfully added payment', __LINE__);
}
