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
    $pCreditcardID = (int)$_POST['cardID'];
    $pAmount = 100; // static subscription payment
    $iManagerID = $_SESSION['managerID'];

    // select statement for checking existing card id's
    $statement = $con->prepare("SELECT nCreditCardID FROM tcreditcard WHERE nCreditCardID = ? AND nManagerID = ?");
    $statement->execute([$pCreditcardID, $iManagerID]);
    $results = $statement->fetch();
    if(empty($results)){
        sendErrorMessage('Please enter an existing credit card ID' , __LINE__);
    } 
    $statement = null;

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
