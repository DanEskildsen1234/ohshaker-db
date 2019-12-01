<?php
require_once(__DIR__.'../../admin-connection.php');
$db = new DB();
$con = $db->connect();

$sManagerID = 14; // get from session
$sTotalAmount = 0; // leave this out?
$sExpiration = $_POST['dExpiration'];
$sCCV = $_POST['cCCV'];
$sIBAN = $_POST['cIBAN'];

// TODO this
/* if(!$_POST){
    sendErrorMessage( 'Invalid origin [!$_POST]' , __LINE__ ); 
}
if(!$_SESSION){
    sendErrorMessage( 'Invalid origin [!$_SESSION]' , __LINE__ ); 
}
if( empty( $_POST['managerID'] ) ){ 
    sendErrorMessage( 'manager ID is missing' , __LINE__ ); 
}
if( empty( $_POST['totalAmount'] ) ){ 
    sendErrorMessage( ' is missing' , __LINE__ ); 
}
if( strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50  ){
    sendErrorMessage( 'cocktail name min 2 max 50 characters' , __LINE__ );
}
if( strlen($_POST['recipe']) < 2 || strlen($_POST['recipe']) > 255  ){
    sendErrorMessage( 'recipe min 2 max 50 characters' , __LINE__ );
} */

if ($con) {
$scQuery = "INSERT INTO tcreditcard (`nManagerID`, `nTotalAmount`, `dExpiration`, `cCCV`, `cIBAN`) VALUES ('$sManagerID', '$sTotalAmount', '$sExpiration', '$sCCV', '$sIBAN')";
$stmt = $con->query($scQuery);
$stmt = null;
$db->disconnect($con);
}