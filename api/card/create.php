<?php
require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { 
    echo sendErrorMessage('Method not allowed', __LINE__);
}

session_start();

if(empty($_SESSION['managerID'])){
    echo sendErrorMessage('No user logged in', __LINE__);
    exit;
}

if(empty($_POST['expiration'])){
    echo sendErrorMessage('Expiration date is required', __LINE__);
    exit;
}

if(empty($_POST['CCV'])){
    echo sendErrorMessage('CCV is required', __LINE__);
    exit;
}

if(empty($_POST['IBAN'])){
    echo sendErrorMessage('IBAN is required', __LINE__);
    exit;
}

$sManagerID = $_SESSION['managerID'];
$sExpiration = $_POST['expiration'];
$sCCV = $_POST['CCV'];
$sIBAN = $_POST['IBAN'];

if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0]|3[0])$/",$sExpiration)) {
    echo sendErrorMessage('Expiration date must be a valid number', __LINE__);
}

if(!ctype_digit(($_POST['CCV']))){
    echo sendErrorMessage('CCV must be a valid number', __LINE__);
    exit;
}

if (strlen($_POST["CCV"]) != 3) {
    echo sendErrorMessage('CCV must be exactly 3 numbers', __LINE__);
    exit;
}

// sanitise IBAN

if (strlen($_POST["IBAN"]) != 18) {
    echo sendErrorMessage('IBAN must be exactly 18 charecters', __LINE__);
    exit;
}

$db = new DB();
$con = $db->connect();

if ($con) {
$scQuery = "INSERT INTO tcreditcard (`nManagerID`, `dExpiration`, `cCCV`, `cIBAN`) VALUES ('$sManagerID', '$sExpiration', '$sCCV', '$sIBAN')";
$statement = $con->prepare($scQuery);
$statement->execute();
$db->disconnect($con);
}
