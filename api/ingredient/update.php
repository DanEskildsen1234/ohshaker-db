<?php
session_start();

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'/validation.php');


validateField($_POST['name']);

$iIngredientID = $_POST['ingredientID'];
$sName = htmlspecialchars($_POST['name'], ENT_QUOTES);

if(strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50){
        sendErrorMessage('Ingredient name min 2 max 50 characters' , __LINE__);
}

$db = new DB();
$con = $db->connect();
if ($con) {
    $results = array();
    $statement = $con->prepare(
        "UPDATE `tingredient` SET `cName` = ? WHERE `tingredient`.`nIngredientID` = ?");
    $statement->execute([$sName, $iIngredientID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Updated ingredient' , __LINE__);
}
