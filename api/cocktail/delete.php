<?php
session_start();

require_once(__DIR__.'../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

$iCocktailID = htmlspecialchars($_POST['cocktailID'], ENT_QUOTES);

$db = new DB();
$con = $db->connect();
    
if ($con) {
    $cQuery = "DELETE FROM `tcocktail` WHERE `tcocktail`.`nCocktailID` = '$iCocktailID'";    
    $stmt = $con->query($cQuery);
    $stmt = null;
    $db->disconnect($con);
}