<?php

require_once(__DIR__ . '../../admin-connection.php');
require_once(__DIR__.'../../functions.php');
require_once(__DIR__.'../../validation.php');

validatePost();

$iIngredientID = $_POST['ingredientID'];
$sName = htmlspecialchars($_POST['name'], ENT_QUOTES);

validateAssetName($sName);

session_start();
validateLoggedIn();

$db = new DB();
$con = $db->connect();
if ($con) {
    
    $statement = $con->prepare(
        "UPDATE `tingredient` SET `cName` = ? WHERE `tingredient`.`nIngredientID` = ?");
    $statement->execute([$sName, $iIngredientID]);
    $stmt = null;
    $db->disconnect($con);
    sendSuccessMessage('Updated ingredient' , __LINE__);
}
