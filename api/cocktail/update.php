<?php
session_start();

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage( 'Not logged in [$_SESSION]' , __LINE__ ); 
}

if(empty($_POST['field'])){
    sendErrorMessage( 'Field is required' , __LINE__ ); 
}

if(empty($_POST['value'])){
    sendErrorMessage( 'Value is required' , __LINE__ ); 
}

$iCocktailID = $_POST['cocktailID'];
$sField = htmlspecialchars($_POST['field']);
$sValue = htmlspecialchars($_POST['value']);
$aAllowedFields =
    array("eShakenStirred", "eCubedCrushed", "cName", "cCocktailRecipe");
if (!in_array($sField, $aAllowedFields)) {
    sendErrorMessage( 'Method not allowed' , __LINE__ ); 
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(
        "UPDATE `tcocktail` SET `$sField` = '$sValue' WHERE `tcocktail`.`nCocktailID` = $iCocktailID");
    $statement->execute();
    echo("Success");
    $stmt = null;
    $db->disconnect($con);
}
