<?php
session_start();

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');

if(empty($_SESSION['managerID'])) {
    sendErrorMessage('Not logged in [$_SESSION]' , __LINE__); 
}

if(empty($_POST['field'])){
    sendErrorMessage('Field is required' , __LINE__); 
}

if ($_POST['field'] !== 'cName') {
    sendErrorMessage('Method not allowed' , __LINE__); 
}

// Sends error message if empty, with the exception of eShakenStirred and eCubedCrushed.
if(empty($_POST['value'])){
    sendErrorMessage('Value is required' , __LINE__); 
}

$iIngredientID = $_POST['ingredientID'];
$sField = htmlspecialchars($_POST['field'], ENT_QUOTES);
$sValue = htmlspecialchars($_POST['value'], ENT_QUOTES);

if ($sField == 'cName') {
    if(strlen($_POST['value']) < 2 || strlen($_POST['value']) > 50){
        sendErrorMessage('Ingredient name min 2 max 50 characters' , __LINE__);
    }
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(
        "UPDATE `tingredient` SET `$sField` = '$sValue' WHERE `tingredient`.`nIngredientID` = $iIngredientID");
    $statement->execute();
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Updated ingredient' , __LINE__);
}
