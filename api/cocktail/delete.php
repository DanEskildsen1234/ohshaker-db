<?php
session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
    exit();
}

$db = new DB();
$con = $db->connect();



$iCocktailID = htmlspecialchars($_POST['cocktailID']);



// $_SESSION['managerID'] = 11;

if(!$_POST){
    sendErrorMessage( 'Invalid origin [!$_POST]' , __LINE__ ); 
}

// if($_SESSION['managerID'] != $iManagerID ){ 
//     sendErrorMessage( 'You are not authenticated' , __LINE__ ); 
// }


if ($con) {
    $cQuery = "DELETE FROM `tcocktail` WHERE `tcocktail`.`nCocktailID` = '$iCocktailID'";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
}